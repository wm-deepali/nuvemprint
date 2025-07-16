<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingRuleAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_rule_id',
        'attribute_id',
        'value_id',
        'price_modifier_type',
        'price_modifier_value',
        'is_default',
    ];

    public function rule()
    {
        return $this->belongsTo(PricingRule::class, 'pricing_rule_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'value_id');
    }
}
