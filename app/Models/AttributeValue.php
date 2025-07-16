<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'attribute_id',
        'value',
        'image_path',
        'icon_class',
        'description',
        'title',
    ];

    /** Value belongs to a parent attribute */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /** Value may be available for specific subcategories */
    public function subcategoryValues()
    {
        return $this->hasMany(SubcategoryAttributeValue::class);
    }

    /** Value may be used in pricing rule modifiers */
    public function pricingRuleAttributes()
    {
        return $this->hasMany(PricingRuleAttribute::class, 'value_id');
    }

    /** Used in conditional logic as parent value */
}