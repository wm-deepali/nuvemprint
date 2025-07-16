<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name',
        'detail',
        'input_type',
        'has_image',
        'has_icon',
    ];

    protected $casts = [
        'has_icon' => 'boolean',
        'has_image' => 'boolean',
    ];


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
