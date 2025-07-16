<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','mobile','mobile_verified_at','email_verified_at','google_id', 'profile_pic',
        'customer_id',
        'country',
        'status',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    
    public function countryname()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }
    
}
