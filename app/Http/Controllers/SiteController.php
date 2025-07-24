<?php
namespace App\Http\Controllers;

use App\Models\PricingRule;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PricingRuleAttribute;
use App\Models\AttributeValue;

class SiteController extends Controller
{

    public function index()
    {
        $categories = Category::where('status', 'active')->get();
        return view('front.index', compact('categories'));

    }

    // public function subcateDetails($slug){
    //     $subcategory = Subcategory::with('details')->where('slug', $slug)->where('status', 'active')->first();
    //     return view('front.subcategory-detail', compact('subcategory'));

    // }

    public function subcateDetails($slug)
    {
        $subcategory = Subcategory::with('details')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $subcategoryId = $subcategory->id;

        $pagesDraggerRequired = PricingRule::where('subcategory_id', $subcategoryId)->value('pages_dragger_required');
        // Set the dragger attribute ID only if required
        $pagesDraggerAttributeId = null;
        if ($pagesDraggerRequired) {
            $pagesDraggerAttributeId = PricingRule::where('subcategory_id', $subcategoryId)
                ->value('pages_dragger_dependency');
        }

        $compositeDraggerValues = [];

        if ($pagesDraggerAttributeId) {
            $attribute = \App\Models\Attribute::find($pagesDraggerAttributeId);
            if ($attribute && $attribute->is_composite) {
                $compositeDraggerValues = \App\Models\SubcategoryAttributeValue::with('value.components')
                    ->where('subcategory_id', $subcategoryId)
                    ->where('attribute_id', $pagesDraggerAttributeId)
                    ->get()
                    ->filter(fn($sav) => $sav->value->is_composite_value)
                    ->map(function ($sav) {
                        return [
                            'id' => $sav->value->id,
                            'value' => $sav->value->value,
                            'component_count' => $sav->value->components->count(),
                            'components' => $sav->value->components->pluck('value')->toArray(), // or use entire object if needed
                        ];
                    })
                    ->values();
            }
        }

        // dd($compositeDraggerValues);

        $attributeValues = \App\Models\SubcategoryAttributeValue::with('value')
            ->where('subcategory_id', $subcategoryId)
            ->get()
            ->groupBy('attribute_id');

        $groupAssignments = \App\Models\AttributeGroupSubcategoryAssignment::with(['group', 'group.attributes'])
            ->where('subcategory_id', $subcategoryId)
            ->orderBy('sort_order', 'asc')
            ->get();

        $subcategoryAttributes = \App\Models\SubcategoryAttribute::with('attribute')
            ->where('subcategory_id', $subcategoryId)
            ->orderBy('sort_order')
            ->get();

        // Create a map for quick lookup of is_required by attribute_id
        $subcategoryAttrMap = $subcategoryAttributes->keyBy('attribute_id');

        // Function to map a single attribute to structured array
        $mapAttributeData = function ($attribute, $is_required) use ($attributeValues) {
            $values = $attributeValues[$attribute->id] ?? collect();

            return [
                'id' => $attribute->id,
                'name' => $attribute->name,
                'input_type' => $attribute->input_type,
                'has_image' => $attribute->has_image,
                'is_composite' => $attribute->is_composite,
                'is_required' => (bool) $is_required,
                'values' => $values->map(function ($sav) use ($attribute) {
                    $valueId = $sav->value->id;

                    $isDefault = PricingRuleAttribute::where('attribute_id', $attribute->id)
                        ->where('value_id', $valueId)
                        ->value('is_default');

                    return [
                        'id' => $valueId,
                        'value' => $sav->value->value,
                        'image_path' => $sav->value->image_path,
                        'is_default' => (bool) $isDefault,
                        'is_composite_value' => $sav->value->is_composite_value,
                    ];
                }),
            ];
        };

        // Grouped attributes
        $attributeGroups = $groupAssignments->map(function ($assignment) use ($mapAttributeData, $subcategoryAttrMap) {
            return [
                'group_name' => $assignment->group->name,
                'sort_order' => $assignment->sort_order,
                'is_toggleable' => $assignment->is_toggleable,
                'attributes' => $assignment->group->attributes->map(function ($attr) use ($mapAttributeData, $subcategoryAttrMap) {
                    $is_required = $subcategoryAttrMap[$attr->id]->is_required ?? false;
                    return $mapAttributeData($attr, $is_required);
                }),
            ];
        });

        // Ungrouped attributes
        $groupedAttributeIds = $groupAssignments
            ->flatMap(fn($ga) => $ga->group->attributes->pluck('id'))
            ->unique()
            ->toArray();

        $ungroupedAttributes = $subcategoryAttributes
            ->filter(function ($sa) use ($groupedAttributeIds) {
                return !in_array($sa->attribute_id, $groupedAttributeIds);
            })
            ->map(fn($sa) => $mapAttributeData($sa->attribute, $sa->is_required));

        if ($ungroupedAttributes->isNotEmpty()) {
            $attributeGroups->prepend([
                'group_name' => 'Main Attributes',
                'sort_order' => 0,
                'is_toggleable' => false,
                'attributes' => $ungroupedAttributes->values(),
            ]);
        }

        // Attribute conditions
        $attributeConditions = \App\Models\AttributeCondition::with(['parentAttribute', 'parentValue', 'affectedAttribute', 'affectedValues'])
            ->where('subcategory_id', $subcategoryId)
            ->get();

        $conditionsMap = $attributeConditions->map(function ($cond) use ($subcategoryId) {
            $affectedValueIds = $cond->affectedValues->pluck('id')->toArray();

            $allValueIds = \App\Models\SubcategoryAttributeValue::where('subcategory_id', $subcategoryId)
                ->where('attribute_id', $cond->affected_attribute_id)
                ->pluck('attribute_value_id')
                ->toArray();

            return [
                'parent_attribute_id' => $cond->parent_attribute_id,
                'parent_value_id' => $cond->parent_value_id,
                'affected_attribute_id' => $cond->affected_attribute_id,
                'affected_value_ids' => $affectedValueIds,
                'all_values_affected' => !array_diff($allValueIds, $affectedValueIds),
                'action' => $cond->action,
            ];
        });

        $compositeMap = collect($compositeDraggerValues)->pluck('component_count', 'id');

        // Always ensure "-- Select --" is present even if there are no values
        $compositeMap = $compositeMap->prepend('-- Select --', '');


        // dd($compositeDraggerValues->toArray());
        return view('front.subcategory-detail', compact(
            'subcategory',
            'attributeGroups',
            'conditionsMap',
            'pagesDraggerRequired',
            'pagesDraggerAttributeId',
            'compositeDraggerValues',
            'compositeMap'
        ));
    }

    public function shopCategories()
    {
        $shpcategories = Category::with('subcategories')->where('status', 'active')->get();
        return view('front.shop-categories', compact('shpcategories'));

    }


    public function calculate(Request $request)
    {
        $componentPages = [];

        // Step 1: Extract page count for component values inside composite values
        if ($request->has('composite_pages')) {
            foreach ($request->input('composite_pages') as $compositeValueId => $labelPages) {
                $composite = AttributeValue::with('components')->find($compositeValueId);
                if ($composite && $composite->is_composite_value) {
                    foreach ($composite->components as $component) {
                        $label = $component->value;
                        if (isset($labelPages[$label])) {
                            $componentPages[$component->id] = (int) $labelPages[$label];
                        }
                    }
                }
            }
        }

        $quantity = (int) $request->input('quantity', 1);
        $defaultPages = (int) $request->input('pages', 0);
        $selectedAttributes = $request->input('attributes', []); // [attribute_id => value_id]

        // Step 2: Expand composite values into individual components
        $expandedAttributes = [];
        foreach ($selectedAttributes as $attributeId => $valueId) {
            $value = AttributeValue::with('components')->find($valueId);
            if ($value && $value->is_composite_value) {
                foreach ($value->components as $component) {
                    $expandedAttributes[$attributeId][] = $component->id;
                }
            } else {
                $expandedAttributes[$attributeId][] = $valueId;
            }
        }

        $total = 0;

        // Step 3: Process each expanded value for pricing
        foreach ($expandedAttributes as $attributeId => $valueIds) {
            foreach ($valueIds as $valueId) {
                $attrs = PricingRuleAttribute::with(['quantityRanges', 'attribute', 'dependencies'])
                    ->where('attribute_id', $attributeId)
                    ->where('value_id', $valueId)
                    ->get();

                $validAttrs = $attrs->filter(function ($item) use ($selectedAttributes, $expandedAttributes) {
                    foreach ($item->dependencies as $dep) {
                        $selected = $selectedAttributes[$dep->parent_attribute_id] ?? null;
                        $matches = $expandedAttributes[$dep->parent_attribute_id] ?? ($selected ? [$selected] : []);
                        if (!in_array($dep->parent_value_id, $matches)) {
                            return false;
                        }
                    }
                    return true;
                });

                foreach ($validAttrs as $attr) {
                    $basis = $attr->attribute->pricing_basis ?? null;
                    $pages = $componentPages[$attr->dependency_value_id] ?? $defaultPages;
                    $rangeInput = ($basis === 'per_page') ? $pages * $quantity : $quantity;

                    $range = $attr->quantityRanges->first(function ($r) use ($rangeInput) {
                        return $rangeInput >= $r->quantity_from && $rangeInput <= $r->quantity_to;
                    });

                    if (!$range && $attr->quantityRanges->isNotEmpty()) {
                        $range = $attr->quantityRanges->sortBy(function ($r) use ($rangeInput) {
                            return min(abs($rangeInput - $r->quantity_from), abs($rangeInput - $r->quantity_to));
                        })->first();
                    }

                    if ($range) {
                        $price = $range->price;
                        match ($basis) {
                            'per_page' => $total += $price * $pages * $quantity,
                            'per_product' => $total += $price * $quantity,
                            default => null,
                        };
                    }

                    // Apply any additional pricing logic
                    if ($basis === 'per_extra_copy') {
                        $total += ($attr->extra_copy_charge ?? 0) * $quantity;
                    }

                    if ($basis === 'fixed_per_page') {
                        $total += ($attr->flat_rate_per_page ?? 0) * $pages * $quantity;
                    }

                    if ($attr->attribute->has_setup_charge ?? false) {
                        $total += $attr->price_modifier_value ?? 0;
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'total_price' => round($total, 2),
            'formatted_price' => '£' . number_format($total, 2),
        ]);
    }

}