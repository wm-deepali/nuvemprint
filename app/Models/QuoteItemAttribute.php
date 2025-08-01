<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteItemAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_item_id',
        'attribute_id',
        'value_id',
    ];

    public function quoteItem()
    {
        return $this->belongsTo(QuoteItem::class);
    }

    // If you have Attribute and Value models, you can optionally define:
    // public function attribute()
    // {
    //     return $this->belongsTo(Attribute::class);
    // }

    // public function value()
    // {
    //     return $this->belongsTo(Value::class, 'value_id');
    // }
}

