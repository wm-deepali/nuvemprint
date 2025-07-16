<?php
namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;

class SiteController extends Controller {

    public function index(){
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

        // Get all pricing attributes for this subcategory
        $pricingAttributes = \App\Models\PricingRuleAttribute::whereHas('rule', function ($q) use ($subcategory) {
            $q->where('subcategory_id', $subcategory->id);
        })->get();

        // Create value_id => price map
        $pricingMap = $pricingAttributes->mapWithKeys(function ($pa) {
            return [
                $pa->value_id => [
                    'type' => $pa->price_modifier_type,
                    'value' => $pa->price_modifier_value,
                    'is_default' => $pa->is_default,
                ]
            ];
        });

        // Load group assignments with group and attributes
        $groupAssignments = \App\Models\AttributeGroupSubcategoryAssignment::with(['group', 'group.attributes'])
            ->where('subcategory_id', $subcategory->id)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Load all subcategory attributes
        $subcategoryAttributes = \App\Models\SubcategoryAttribute::with('attribute')
            ->where('subcategory_id', $subcategory->id)
            ->orderBy('sort_order')
            ->get();

        $groupedAttributeIds = $groupAssignments
            ->flatMap(fn($ga) => $ga->group->attributes->pluck('id'))
            ->unique()
            ->toArray();

        // Helper for building attribute data
        $mapAttributeData = function ($attribute) use ($subcategory, $pricingMap) {
            $values = \App\Models\SubcategoryAttributeValue::with('value')
                ->where('subcategory_id', $subcategory->id)
                ->where('attribute_id', $attribute->id)
                ->get()
                ->map(function ($sav) use ($pricingMap) {
                    $pricing = $pricingMap[$sav->value->id] ?? null;
                    return [
                        'id' => $sav->value->id,
                        'value' => $sav->value->value,
                        'image_path' => $sav->value->image_path ?? null,
                        'price' => $pricing['value'] ?? 0,
                        'price_modifier_type' => $pricing['type'] ?? 'add',
                        'is_default' => $pricing['is_default'] ?? false,
                    ];
                });

            return [
                'id' => $attribute->id,
                'name' => $attribute->name,
                'input_type' => $attribute->input_type,
                'values' => $values,
                'has_image' => $attribute->has_image,
                'is_required' => $attribute->pivot->is_required ?? false,
            ];
        };

        // Grouped attribute groups
        $attributeGroups = $groupAssignments->map(function ($assignment) use ($mapAttributeData) {
            $group = $assignment->group;

            return [
                'group_name' => $group->name,
                'sort_order' => $assignment->sort_order,
                'is_toggleable' => $assignment->is_toggleable,
                'attributes' => $group->attributes->map($mapAttributeData),
            ];
        });

        // Ungrouped attributes ("Main Attributes")
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

        // Quantity pricing
        $quantityPricing = \App\Models\PricingRuleQuantity::whereHas('rule', function ($q) use ($subcategory) {
            $q->where('subcategory_id', $subcategory->id);
        })->get();

        // Attribute conditions
        $attributeConditions = \App\Models\AttributeCondition::with(['parentAttribute', 'parentValue', 'affectedAttribute', 'affectedValues'])
            ->where('subcategory_id', $subcategory->id)
            ->get();

        $conditionsMap = $attributeConditions->map(function ($cond) {
            $valueIds = $cond->affectedValues->pluck('id')->toArray();

            // Get all possible values for the affected attribute
            $allValueIds = \App\Models\SubcategoryAttributeValue::where('subcategory_id', $cond->subcategory_id)
                ->where('attribute_id', $cond->affected_attribute_id)
                ->pluck('attribute_value_id')
                ->toArray();

            $allSelected = !empty($valueIds) && empty(array_diff($allValueIds, $valueIds));

            return [
                'parent_attribute_id' => $cond->parent_attribute_id,
                'parent_value_id' => $cond->parent_value_id,
                'affected_attribute_id' => $cond->affected_attribute_id,
                'affected_value_ids' => $valueIds,
                'all_values_affected' => $allSelected, // <-- NEW correct logic
                'action' => $cond->action,
            ];
        });

        // dd($conditionsMap->toArray());
        return view('front.subcategory-detail', compact(
            'subcategory',
            'attributeGroups',
            'quantityPricing',
            'conditionsMap'
        ));
    }


    public function shopCategories(){
        $shpcategories = Category::with('subcategories')->where('status', 'active')->get();
        return view('front.shop-categories', compact('shpcategories'));
    
    }
}