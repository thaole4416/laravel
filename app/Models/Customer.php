<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function affiliates()
    {
        return $this->belongsToMany(Affiliate::class, 'affiliate_customer', 'customer_id', 'affiliate_id')
                    ->withTimestamps();
    }
}
