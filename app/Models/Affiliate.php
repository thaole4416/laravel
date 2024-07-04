<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email'];
  
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'affiliate_customer', 'affiliate_id', 'customer_id')
                    ->withTimestamps();
    }
}
