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
use App\Models\SubcategoryAttribute;
use App\Models\SubcategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PricingRuleAttributeDependency;
use Illuminate\Validation\Rule;

class PricingRuleController extends Controller
{

    public function index()
    {
        $rules = PricingRule::with([
            'category',
            'subcategory',
            'attributes.attribute',
            'attributes.value',
            'attributes.quantityRanges',
            'attributes.dependencies.parentAttribute',
            'attributes.dependencies.parentValue',
        ])->latest()->get();

        // Collect all non-null pages_dragger_dependency IDs
        $dependencyAttrIds = $rules->pluck('pages_dragger_dependency')->filter()->unique();

        // Get those attributes and key them by ID
        $dependencyAttrs = Attribute::whereIn('id', $dependencyAttrIds)->get()->keyBy('id');

        // dd($rules->toArray());
        return view('admin.pricing-rules.index', compact('rules', 'dependencyAttrs'));
    }

    public function show($id)
    {
        $rule = PricingRule::with([
            'category',
            'subcategory',
            'attributes.attribute',
            'attributes.value',
            'attributes.quantityRanges',
            'attributes.dependencies.parentAttribute',
            'attributes.dependencies.parentValue',
        ])->latest()->find($id);

        // Collect all non-null pages_dragger_dependency IDs
        $dependencyAttrIds = $rule->pluck('pages_dragger_dependency')->filter()->unique();

        // Get those attributes and key them by ID
        $dependencyAttrs = Attribute::whereIn('id', $dependencyAttrIds)->get()->keyBy('id');

        // dd($rules->toArray());
        return view('admin.pricing-rules.view', compact('rule', 'dependencyAttrs'));
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
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'pages_dragger_required' => 'nullable',
            'pages_dragger_dependency' => 'nullable|numeric',
            'default_quantity' => 'required|integer|min:1',
            'proof_reading_required' => 'nullable|boolean',
            'delivery_charges_required' => 'nullable|boolean',
            'min_quantity' => 'nullable|integer|min:1|lte:max_quantity',
            'max_quantity' => 'nullable|integer|min:1|gte:min_quantity',
            'min_pages' => 'nullable|integer|min:1|lte:max_pages',
            'max_pages' => 'nullable|integer|min:1|gte:min_pages',

            'default_pages' => [
                'nullable',
                'integer',
                'min:1',
                Rule::requiredIf($request->pages_dragger_required == '1'),
            ],

            'rows' => 'array',
            'rows.*.attribute_id' => 'required|exists:attributes,id',
            'rows.*.value_id' => 'required|exists:attribute_values,id',
            'rows.*.dependency_value_ids' => 'nullable|array',
            'rows.*.dependency_value_ids.*' => 'nullable|exists:attribute_values,id',
            'rows.*.modifier_type' => 'nullable|in:add,multiply',
            'rows.*.modifier_value' => 'nullable|numeric',
            'rows.*.base_charges_type' => 'nullable|in:amount,percentage',
            'rows.*.flat_rate_per_page' => 'nullable|numeric|min:0',
            'rows.*.extra_copy_charge' => 'nullable|numeric|min:0',
            'rows.*.extra_copy_charge_type' => 'nullable|in:amount,percentage',
            'rows.*.is_default' => 'nullable|boolean',
            'rows.*.per_page_pricing' => 'nullable|array',
            'rows.*.per_page_pricing.*.quantity_from' => 'required_with:rows.*.per_page_pricing|integer|min:1',
            'rows.*.per_page_pricing.*.quantity_to' => 'required_with:rows.*.per_page_pricing|integer|min:1|gte:rows.*.per_page_pricing.*.quantity_from',
            'rows.*.per_page_pricing.*.price' => 'required_with:rows.*.per_page_pricing|numeric|min:0',
        ]);


        DB::beginTransaction();

        try {
            $pricingRule = PricingRule::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'pages_dragger_required' => (int) $request->pages_dragger_required,
                'pages_dragger_dependency' => $request->pages_dragger_dependency ?? null,
                'default_quantity' => $request->default_quantity ?? null,
                'default_pages' => $request->default_pages ?? null,
                'min_quantity' => $request->min_quantity ?? null,
                'max_quantity' => $request->max_quantity ?? null,
                'min_pages' => $request->min_pages ?? null,
                'max_pages' => $request->max_pages ?? null,
                'proof_reading_required' => (int) $request->proof_reading_required,
                'delivery_charges_required' => (int) $request->delivery_charges_required,
            ]);

            foreach ($request->rows as $row) {
                $attribute = PricingRuleAttribute::create([
                    'pricing_rule_id' => $pricingRule->id,
                    'attribute_id' => $row['attribute_id'],
                    'value_id' => $row['value_id'],
                    // 'dependency_value_id' => $row['dependency_value_id'] ?? null,
                    'price_modifier_type' => $row['modifier_type'] ?? 'add',
                    'price_modifier_value' => $row['modifier_value'] ?? 0,
                    'is_default' => isset($row['is_default']) && $row['is_default'] ? 1 : 0,
                    'base_charges_type' => $row['base_charges_type'] ?? null,
                    'extra_copy_charge' => $row['extra_copy_charge'] ?? null,
                    'extra_copy_charge_type' => $row['extra_copy_charge_type'] ?? null,
                    'flat_rate_per_page' => $row['flat_rate_per_page'] ?? null,
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
                if (!empty($row['dependency_value_ids'])) {
                    foreach ($row['dependency_value_ids'] as $parentAttrId => $valueId) {
                        if ($valueId) {
                            PricingRuleAttributeDependency::create([
                                'pricing_rule_attribute_id' => $attribute->id,
                                'parent_attribute_id' => $parentAttrId,
                                'parent_value_id' => $valueId,
                            ]);
                        }
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
        $pricingRule->load([
            'attributes.attribute',
            'attributes.value',
            'attributes.quantityRanges',
            'attributes.dependencies',
            'subcategory',
            'category'
        ]);
        $subcategoryAttributes = SubcategoryAttribute::with('attribute.parents')
            ->where('subcategory_id', $pricingRule->subcategory_id)
            ->get();

        $attributes = $subcategoryAttributes->map(function ($sa) {
            // Fetch filtered values
            $values = SubcategoryAttributeValue::with('value')
                ->where('subcategory_id', $sa->subcategory_id)
                ->where('attribute_id', $sa->attribute_id)
                ->get()
                ->map(function ($sav) {
                    return [
                        'id' => $sav->value->id,
                        'value' => $sav->value->value,
                        'is_composite_value' => $sav->value->is_composite_value,
                    ];
                });

            return [
                'id' => $sa->attribute->id,
                'name' => $sa->attribute->name,
                'values' => $values,
                'pricing_basis' => $sa->attribute->pricing_basis,
                'has_setup_charge' => $sa->attribute->has_setup_charge,
                'has_dependency' => $sa->attribute->has_dependency,
                'dependency_parents' => $sa->attribute->parents->pluck('id'),
            ];

        });
        // dd($attributes->toArray());
        return view('admin.pricing-rules.edit', [
            'pricingRule' => $pricingRule,
            'subcategoryAttributes' => $attributes,
        ]);
    }


    public function update(Request $request, PricingRule $pricingRule)
    {
        // dd($request->all());
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'pages_dragger_required' => 'nullable|boolean',
            'pages_dragger_dependency' => 'nullable|numeric',
            'default_quantity' => 'required|integer|min:1',
            'proof_reading_required' => 'nullable|boolean',
            'delivery_charges_required' => 'nullable|boolean',
            'min_quantity' => 'nullable|integer|min:1|lte:max_quantity',
            'max_quantity' => 'nullable|integer|min:1|gte:min_quantity',
            'min_pages' => 'nullable|integer|min:1|lte:max_pages',
            'max_pages' => 'nullable|integer|min:1|gte:min_pages',
            'default_pages' => [
                'nullable',
                'integer',
                'min:1',
                Rule::requiredIf($request->pages_dragger_required == '1'),
            ],

            'rows' => 'nullable|array',
            'rows.*.id' => 'nullable|exists:pricing_rule_attributes,id',
            'rows.*.attribute_id' => 'required|exists:attributes,id',
            'rows.*.value_id' => 'required|exists:attribute_values,id',
            'rows.*.dependency_value_ids' => 'nullable|array',
            'rows.*.dependency_value_ids.*' => 'nullable|exists:attribute_values,id',
            'rows.*.modifier_type' => 'nullable|in:add,multiply',
            'rows.*.modifier_value' => 'nullable|numeric',
            'rows.*.base_charges_type' => 'nullable|in:amount,percentage',
            'rows.*.flat_rate_per_page' => 'nullable|numeric|min:0',
            'rows.*.extra_copy_charge' => 'nullable|numeric|min:0',
            'rows.*.extra_copy_charge_type' => 'nullable|in:amount,percentage',
            'rows.*.is_default' => 'nullable|in:1',
            'rows.*.per_page_pricing' => 'nullable|array',
            'rows.*.per_page_pricing.*.id' => 'nullable|integer|exists:pricing_rule_attribute_quantities,id',
            'rows.*.per_page_pricing.*.quantity_from' => 'nullable|integer|min:1',
            'rows.*.per_page_pricing.*.quantity_to' => 'nullable|integer|min:1',
            'rows.*.per_page_pricing.*.price' => 'nullable|numeric|min:0',
        ]);
        // dd((int) $request->delivery_charges_required);
        DB::beginTransaction();

        try {
            // Update main pricing rule
            $pricingRule->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'pages_dragger_required' => filter_var($request->pages_dragger_required, filter: FILTER_VALIDATE_BOOLEAN),
                'pages_dragger_dependency' => $request->pages_dragger_dependency ?? null,
                'default_quantity' => $request->default_quantity ?? null,
                'default_pages' => $request->default_pages ?? null,
                'min_quantity' => $request->min_quantity ?? null,
                'max_quantity' => $request->max_quantity ?? null,
                'min_pages' => $request->min_pages ?? null,
                'max_pages' => $request->max_pages ?? null,
                'proof_reading_required' => filter_var($request->proof_reading_required, filter: FILTER_VALIDATE_BOOLEAN),
                'delivery_charges_required' => filter_var($request->delivery_charges_required, filter: FILTER_VALIDATE_BOOLEAN),
            ]);

            foreach ($request->input('rows', []) as $row) {
                $data = [
                    'attribute_id' => $row['attribute_id'],
                    'value_id' => $row['value_id'],
                    // 'dependency_value_id' => $row['dependency_value_id'] ?? null,
                    'price_modifier_type' => $row['modifier_type'] ?? 'add',
                    'price_modifier_value' => $row['modifier_value'] ?? 0,
                    'is_default' => isset($row['is_default']) ? 1 : 0,
                    'base_charges_type' => $row['base_charges_type'] ?? null,
                    'extra_copy_charge' => $row['extra_copy_charge'] ?? null,
                    'extra_copy_charge_type' => $row['extra_copy_charge_type'] ?? null,
                    'flat_rate_per_page' => $row['flat_rate_per_page'] ?? null,
                ];

                if (!empty($row['id'])) {
                    // Update existing attribute
                    $attribute = $pricingRule->attributes()->where('id', $row['id'])->first();
                    $attribute->update($data);
                } else {
                    // Create new attribute
                    $attribute = $pricingRule->attributes()->create($data);
                }

                // Handle per_page_pricing
                $submittedRangeIds = [];

                if (!empty($row['per_page_pricing']) && is_array($row['per_page_pricing'])) {
                    // dd($row['per_page_pricing']);
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

                if (!empty($row['dependency_value_ids'])) {
                    $submittedDepKeys = [];

                    foreach ($row['dependency_value_ids'] as $parentAttrId => $valueId) {
                        if ($valueId) {
                            $submittedDepKeys[] = $parentAttrId;

                            // Update if exists, otherwise create
                            PricingRuleAttributeDependency::updateOrCreate(
                                [
                                    'pricing_rule_attribute_id' => $attribute->id,
                                    'parent_attribute_id' => $parentAttrId,
                                ],
                                ['parent_value_id' => $valueId]
                            );
                        }
                    }

                    // Delete dependencies that were not submitted (i.e., removed)
                    PricingRuleAttributeDependency::where('pricing_rule_attribute_id', $attribute->id)
                        ->whereNotIn('parent_attribute_id', $submittedDepKeys)
                        ->delete();
                }

            }

            // 1. Handle deleted rows
            $rawDeletedIds = $request->input('deleted_ids', []);
            $deletedIds = [];

            foreach ($rawDeletedIds as $item) {
                if (is_string($item) && str_starts_with($item, '[')) {
                    $decoded = json_decode($item, true);
                    if (is_array($decoded)) {
                        $deletedIds = array_merge($deletedIds, $decoded);
                    }
                } else {
                    $deletedIds[] = $item;
                }
            }

            if (!empty($deletedIds)) {
                PricingRuleAttributeQuantity::whereIn('pricing_rule_attribute_id', $deletedIds)->delete();
                PricingRuleAttributeDependency::whereIn('pricing_rule_attribute_id', $deletedIds)->delete();
                $pricingRule->attributes()->whereIn('id', $deletedIds)->delete();
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
