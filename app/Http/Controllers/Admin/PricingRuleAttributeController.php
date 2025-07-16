<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingRule;
use App\Models\PricingRuleAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class PricingRuleAttributeController extends Controller
{
    public function create(PricingRule $pricingRule)
    {
        $attributes = Attribute::orderBy('name')->get();
        $values     = AttributeValue::orderBy('value')->get();
        return view('admin.pricing-rule-attributes.create', compact('pricingRule', 'attributes', 'values'));
    }

    public function store(Request $request, PricingRule $pricingRule)
    {
        $request->validate([
            'attribute_id'          => 'required|exists:attributes,id',
            'value_id'              => 'required|exists:attribute_values,id',
            'price_modifier_type'   => 'required|in:add,multiply',
            'price_modifier_value'  => 'required|numeric',
        ]);

        $pricingRule->attributes()->create($request->only([
            'attribute_id', 'value_id', 'price_modifier_type', 'price_modifier_value'
        ]));

        return redirect()->route('admin.pricing-rules.edit', $pricingRule)
                         ->with('success', 'Modifier added.');
    }

    public function destroy(PricingRuleAttribute $pricingRuleAttribute)
    {
        $rule = $pricingRuleAttribute->pricingRule;
        $pricingRuleAttribute->delete();

        return redirect()->route('admin.pricing-rules.edit', $rule)
                         ->with('success', 'Modifier deleted.');
    }
}
