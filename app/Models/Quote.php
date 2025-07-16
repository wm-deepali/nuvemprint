<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['subcategory_id', 'user_id', 'quantity', 'total_price', 'quote_data'];

    protected $casts = [
        'quote_data' => 'array',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


