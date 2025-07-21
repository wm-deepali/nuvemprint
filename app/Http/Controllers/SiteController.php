<?php
namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;

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
        // Step 1: Load the subcategory
        $subcategory = Subcategory::with('details')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $subcategoryId = $subcategory->id;

        // Step 2: Fetch all pricing modifiers for attribute values
        $pricingAttributes = \App\Models\PricingRuleAttribute::whereHas('rule', function ($q) use ($subcategoryId) {
            $q->where('subcategory_id', $subcategoryId);
        })->get();

        $pricingMap = $pricingAttributes->mapWithKeys(fn($pa) => [
            $pa->value_id => [
                'type' => $pa->price_modifier_type,
                'value' => $pa->price_modifier_value,
                'is_default' => $pa->is_default,
                'base_charges_type' => $pa->base_charges_type,
                'extra_copy_charge' => $pa->extra_copy_charge,
                'extra_copy_charge_type' => $pa->extra_copy_charge_type,
            ]
        ]);

        // Step 3: Load all attribute values for the subcategory
        $attributeValues = \App\Models\SubcategoryAttributeValue::with('value')
            ->where('subcategory_id', $subcategoryId)
            ->get()
            ->groupBy('attribute_id');

        // Step 4: Load grouped assignments and all subcategory attributes
        $groupAssignments = \App\Models\AttributeGroupSubcategoryAssignment::with(['group', 'group.attributes'])
            ->where('subcategory_id', $subcategoryId)
            ->orderBy('sort_order', 'asc')
            ->get();

        $subcategoryAttributes = \App\Models\SubcategoryAttribute::with('attribute')
            ->where('subcategory_id', $subcategoryId)
            ->orderBy('sort_order')
            ->get();

        $groupedAttributeIds = $groupAssignments
            ->flatMap(fn($ga) => $ga->group->attributes->pluck('id'))
            ->unique()
            ->toArray();

        // Step 5: Build attribute display data
        $mapAttributeData = function ($attribute) use ($pricingMap, $attributeValues) {
            $values = $attributeValues[$attribute->id] ?? collect();

            return [
                'id' => $attribute->id,
                'name' => $attribute->name,
                'input_type' => $attribute->input_type,
                'has_image' => $attribute->has_image,
                'is_required' => $attribute->pivot->is_required ?? false,
                'values' => $values->map(function ($sav) use ($pricingMap) {
                    $pricing = $pricingMap[$sav->value->id] ?? null;
                    return [
                        'id' => $sav->value->id,
                        'value' => $sav->value->value,
                        'image_path' => $sav->value->image_path ?? null,
                        'price' => $pricing['value'] ?? 0,
                        'price_modifier_type' => $pricing['type'] ?? 'add',
                        'is_default' => $pricing['is_default'] ?? false,
                        'base_charges_type' => $pricing['base_charges_type'] ?? null,
                        'extra_copy_charge' => $pricing['extra_copy_charge'] ?? 0,
                        'extra_copy_charge_type' => $pricing['extra_copy_charge_type'] ?? null,
                    ];
                }),
            ];
        };

        // Step 6: Grouped attributes (by groups)
        $attributeGroups = $groupAssignments->map(function ($assignment) use ($mapAttributeData) {
            return [
                'group_name' => $assignment->group->name,
                'sort_order' => $assignment->sort_order,
                'is_toggleable' => $assignment->is_toggleable,
                'attributes' => $assignment->group->attributes->map($mapAttributeData),
            ];
        });

        // Step 7: Ungrouped attributes
        $ungroupedAttributes = $subcategoryAttributes->filter(function ($sa) use ($groupedAttributeIds) {
            return !in_array($sa->attribute_id, $groupedAttributeIds);
        })->map(function ($sa) use ($mapAttributeData) {
            return $mapAttributeData($sa->attribute);
        });

        if ($ungroupedAttributes->isNotEmpty()) {
            $attributeGroups->prepend([
                'group_name' => 'Main Attributes',
                'sort_order' => 0,
                'is_toggleable' => false,
                'attributes' => $ungroupedAttributes->values(),
            ]);
        }

        // Step 8: Quantity pricing
        $quantityPricing = \App\Models\PricingRuleQuantity::whereHas('rule', function ($q) use ($subcategoryId) {
            $q->where('subcategory_id', $subcategoryId);
        })->get();

        // Step 9: Attribute conditions
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

        // dd($attributeGroups->toArray(),);
        // Step 10: Return view
        return view('front.subcategory-detail', compact(
            'subcategory',
            'attributeGroups',
            'quantityPricing',
            'conditionsMap'
        ));
    }



    public function shopCategories()
    {
        $shpcategories = Category::with('subcategories')->where('status', 'active')->get();
        return view('front.shop-categories', compact('shpcategories'));

    }
}