<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\PricingRule;
use App\Models\PricingRuleAttribute;
use App\Models\PricingRuleAttributeQuantity;
use App\Models\PricingRuleQuantity;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PricingRuleController extends Controller
{

    public function index()
    {
        $rules = PricingRule::with([
            'category',
            'subcategory',
            'attributes.attribute',
            'attributes.value',
            'attributes.quantityRanges'
        ])->latest()->get();


        return view('admin.pricing-rules.index', compact('rules'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();
        $attributes = Attribute::with('values')->get();
        return view('admin.pricing-rules.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',

            'rows' => 'array',
            'rows.*.attribute_id' => 'required|exists:attributes,id',
            'rows.*.value_id' => 'required|exists:attribute_values,id',
            'rows.*.dependency_value_id' => 'nullable|exists:attribute_values,id',
            'rows.*.modifier_type' => 'required|in:add,multiply',
            'rows.*.modifier_value' => 'nullable|numeric',
            'rows.*.base_charges_type' => 'nullable|in:amount,percentage',
            'rows.*.extra_copy_charge' => 'nullable|numeric|min:0',
            'rows.*.extra_copy_charge_type' => 'nullable|in:amount,percentage',
            'rows.*.is_default' => 'nullable|boolean',
            'rows.*.per_page_pricing' => 'nullable|array',
            'rows.*.per_page_pricing.*.quantity_from' => 'required_with:rows.*.per_page_pricing|integer|min:1',
            'rows.*.per_page_pricing.*.quantity_to' => 'required_with:rows.*.per_page_pricing|integer|min:1|gte:rows.*.per_page_pricing.*.quantity_from',
            'rows.*.per_page_pricing.*.price' => 'required_with:rows.*.per_page_pricing|numeric|min:0',
        ];


        DB::beginTransaction();

        try {
            $pricingRule = PricingRule::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
            ]);

            foreach ($request->rows as $row) {
                $attribute = PricingRuleAttribute::create([
                    'pricing_rule_id' => $pricingRule->id,
                    'attribute_id' => $row['attribute_id'],
                    'value_id' => $row['value_id'],
                    'dependency_value_id' => $row['dependency_value_id'] ?? null,
                    'price_modifier_type' => $row['modifier_type'],
                    'price_modifier_value' => $row['modifier_value'] ?? 0,
                    'is_default' => isset($row['is_default']) && $row['is_default'] ? 1 : 0,
                    'base_charges_type' => $row['base_charges_type'] ?? null,
                    'extra_copy_charge' => $row['extra_copy_charge'] ?? null,
                    'extra_copy_charge_type' => $row['extra_copy_charge_type'] ?? null,
                ]);

                // Save quantity ranges if provided
                if (!empty($row['per_page_pricing'])) {
                    foreach ($row['per_page_pricing'] as $range) {
                        PricingRuleAttributeQuantity::create([
                            'pricing_rule_attribute_id' => $attribute->id,
                            'quantity_from' => $range['quantity_from'],
                            'quantity_to' => $range['quantity_to'],
                            'price' => $range['price'],
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Pricing rule created successfully!',
                'redirect' => route('admin.pricing-rules.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(PricingRule $pricingRule)
    {
        $pricingRule->load(['attributes.attribute', 'attributes.value', 'attributes.quantityRanges', 'subcategory', 'category']);

        // Fetch all attributes for the subcategory (with their values)
        $subcategoryAttributes = Attribute::with('values')
            ->whereHas('subcategories', function ($q) use ($pricingRule) {
                $q->where('subcategory_id', $pricingRule->subcategory_id);
            })->get();

        return view('admin.pricing-rules.edit', compact('pricingRule', 'subcategoryAttributes'));
    }

    public function update(Request $request, PricingRule $pricingRule)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'rows' => 'nullable|array',
            'rows.*.id' => 'nullable|exists:pricing_rule_attributes,id',
            'rows.*.attribute_id' => 'required|exists:attributes,id',
            'rows.*.value_id' => 'required|exists:attribute_values,id',
            'rows.*.dependency_value_id' => 'nullable|exists:attribute_values,id',
            'rows.*.modifier_type' => 'required|in:add,multiply',
            'rows.*.modifier_value' => 'required|numeric',
            'rows.*.base_charges_type' => 'nullable|in:amount,percentage',
            'rows.*.extra_copy_charge' => 'nullable|numeric|min:0',
            'rows.*.extra_copy_charge_type' => 'nullable|in:amount,percentage',
            'rows.*.is_default' => 'nullable|in:1',
            'rows.*.per_page_pricing' => 'nullable|array',
            'rows.*.per_page_pricing.*.id' => 'nullable|integer|exists:pricing_rule_attribute_quantities,id',
            'rows.*.per_page_pricing.*.quantity_from' => 'nullable|integer|min:1',
            'rows.*.per_page_pricing.*.quantity_to' => 'nullable|integer|min:1',
            'rows.*.per_page_pricing.*.price' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Update main pricing rule
            $pricingRule->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
            ]);

            $existingIds = $pricingRule->attributes()->pluck('id')->toArray();
            $submittedIds = [];

            foreach ($request->input('rows', []) as $row) {
                $data = [
                    'attribute_id' => $row['attribute_id'],
                    'value_id' => $row['value_id'],
                    'dependency_value_id' => $row['dependency_value_id'] ?? null,
                    'price_modifier_type' => $row['modifier_type'],
                    'price_modifier_value' => $row['modifier_value'],
                    'is_default' => isset($row['is_default']) ? 1 : 0,
                    'base_charges_type' => $row['base_charges_type'] ?? null,
                    'extra_copy_charge' => $row['extra_copy_charge'] ?? null,
                    'extra_copy_charge_type' => $row['extra_copy_charge_type'] ?? null,
                ];

                if (!empty($row['id'])) {
                    // Update existing attribute
                    $submittedIds[] = $row['id'];
                    $attribute = $pricingRule->attributes()->where('id', $row['id'])->first();
                    $attribute->update($data);
                } else {
                    // Create new attribute
                    $attribute = $pricingRule->attributes()->create($data);
                    $submittedIds[] = $attribute->id;
                }

                // Handle per_page_pricing
                $submittedRangeIds = [];

                if (!empty($row['per_page_pricing']) && is_array($row['per_page_pricing'])) {
                    foreach ($row['per_page_pricing'] as $range) {
                        if (!empty($range['quantity_from']) && !empty($range['quantity_to']) && isset($range['price'])) {
                            if (!empty($range['id'])) {
                                // Update existing range
                                $attribute->quantityRanges()->updateOrCreate(
                                    ['id' => $range['id']],
                                    [
                                        'quantity_from' => $range['quantity_from'],
                                        'quantity_to' => $range['quantity_to'],
                                        'price' => $range['price'],
                                    ]
                                );
                                $submittedRangeIds[] = $range['id'];
                            } else {
                                // Create new range
                                $newRange = $attribute->quantityRanges()->create([
                                    'quantity_from' => $range['quantity_from'],
                                    'quantity_to' => $range['quantity_to'],
                                    'price' => $range['price'],
                                ]);
                                $submittedRangeIds[] = $newRange->id;
                            }
                        }
                    }

                    // Delete ranges that were removed
                    $attribute->quantityRanges()
                        ->whereNotIn('id', $submittedRangeIds)
                        ->delete();
                }
            }

            // Delete removed attributes
            $toDelete = array_diff($existingIds, $submittedIds);
            if (!empty($toDelete)) {
                PricingRuleAttributeQuantity::whereIn('pricing_rule_attribute_id', $toDelete)->delete();
                $pricingRule->attributes()->whereIn('id', $toDelete)->delete();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pricing rule updated successfully!',
                'redirect' => route('admin.pricing-rules.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update pricing rule.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function destroy(PricingRule $pricingRule)
    {
        DB::beginTransaction();
        try {
            // Delete related quantity ranges
            $pricingRule->quantities()->delete();

            // Delete related attribute modifiers
            $pricingRule->attributes()->delete();

            // Delete the pricing rule itself
            $pricingRule->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Rule deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete the rule.']);
        }
    }

}
