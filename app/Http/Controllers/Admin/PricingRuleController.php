<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\PricingRule;
use App\Models\PricingRuleAttribute;
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
            'quantities',
            'attributes.attribute',
            'attributes.value'
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
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',

            'quantity_from.*' => 'required|numeric|min:1',
            'quantity_to.*' => 'required|numeric|min:1|gte:quantity_from.*',
            'base_price.*' => 'required|numeric|min:0',

            'attribute_id.*' => 'required|exists:attributes,id',
            'value_id.*' => 'required|exists:attribute_values,id',
            'modifier_type.*' => 'required|in:add,multiply',
            'modifier_value.*' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Step 1: Create pricing rule (main group)
            $pricingRule = PricingRule::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
            ]);

            // Step 2: Save all quantity ranges
            foreach ($request->quantity_from as $index => $from) {
                PricingRuleQuantity::create([
                    'pricing_rule_id' => $pricingRule->id,
                    'quantity_from' => $from,
                    'quantity_to' => $request->quantity_to[$index],
                    'base_price' => $request->base_price[$index],
                ]);
            }

            // Step 3: Save attribute modifiers (if present)
            if ($request->has('attribute_id')) {
                foreach ($request->attribute_id as $index => $attributeId) {
                    if (!$attributeId || !$request->value_id[$index]) {
                        continue;
                    }

                    PricingRuleAttribute::create([
                        'pricing_rule_id' => $pricingRule->id,
                        'attribute_id' => $attributeId,
                        'value_id' => $request->value_id[$index],
                        'price_modifier_type' => $request->modifier_type[$index],
                        'price_modifier_value' => $request->modifier_value[$index],
                        'is_default' => isset($request->is_default[$index]) ? 1 : 0,

                    ]);
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

            return response()->json([
                'success' => false,
                'message' => 'Failed to save pricing rule.',
                'error' => $e->getMessage(), // Optional: for debugging
            ], 500);
        }
    }


    public function edit(PricingRule $pricingRule)
    {
        $pricingRule->load(['quantities', 'attributes.attribute', 'attributes.value', 'subcategory', 'category']);

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
            'quantity_from.*' => 'required|numeric|min:1',
            'quantity_to.*' => 'required|numeric|min:1|gte:quantity_from.*',
            'base_price.*' => 'required|numeric|min:0',
            'attribute_id.*' => 'required|exists:attributes,id',
            'value_id.*' => 'required|exists:attribute_values,id',
            'modifier_type.*' => 'required|in:add,multiply',
            'modifier_value.*' => 'required|numeric',
            'is_default.*' => 'nullable|in:0,1',
        ]);

        DB::beginTransaction();
        try {
            $pricingRule->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
            ]);

            // Clear old data
            $pricingRule->quantities()->delete();
            $pricingRule->attributes()->delete();

            // Recreate quantities
            foreach ($request->quantity_from as $index => $from) {
                $pricingRule->quantities()->create([
                    'quantity_from' => $from,
                    'quantity_to' => $request->quantity_to[$index],
                    'base_price' => $request->base_price[$index],
                ]);
            }

            // Recreate attributes
            if ($request->has('attribute_id')) {
                foreach ($request->attribute_id as $index => $attributeId) {
                    if (!$attributeId || !$request->value_id[$index]) {
                        continue;
                    }

                    $pricingRule->attributes()->create([
                        'attribute_id' => $attributeId,
                        'value_id' => $request->value_id[$index],
                        'price_modifier_type' => $request->modifier_type[$index],
                        'price_modifier_value' => $request->modifier_value[$index],
                        'is_default' => $request->is_default[$index] ?? 0, // <-- handle default checkbox
                    ]);
                }
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
