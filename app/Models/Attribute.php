<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name',
        'detail',
        'input_type',
        'pricing_basis',
        'has_setup_charge',
        'allow_quantity',
        'is_composite',
        'has_dependency',
        'dependency_parent',
        'custom_input_type',
        'has_image',
        'has_icon',
    ];

    protected $casts = [
        'has_icon' => 'boolean',
        'has_image' => 'boolean',
        'allow_quantity' => 'boolean',
        'is_composite' => 'boolean',
        'has_dependency' => 'boolean',
        'pricing_basis' => 'string',
        'has_setup_charge' => 'boolean'
    ];

    public function parentAttribute()
    {
        return $this->belongsTo(Attribute::class, 'dependency_parent');
    }

    /** Attribute has many possible values */
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    /** Attribute may belong to many subcategories */
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'subcategory_attributes')
            ->withPivot(['is_required', 'sort_order'])
            ->withTimestamps();
    }

    /** Attribute as parent in dependency logic */
    public function parentConditions()
    {
        return $this->hasMany(AttributeCondition::class, 'parent_attribute_id');
    }

    /** Attribute as affected in dependency logic */
    public function affectedConditions()
    {
        return $this->hasMany(AttributeCondition::class, 'affected_attribute_id');
    }

    /** Used in pricing modifiers */
    public function pricingRuleAttributes()
    {
        return $this->hasMany(PricingRuleAttribute::class);
    }

    public function groups()
    {
        return $this->belongsToMany(AttributeGroup::class, 'attribute_group_attribute');
    }

}
