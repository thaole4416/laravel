<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateCustomer extends Model
{
    use HasFactory;

    protected $table = 'affiliate_customer';

    protected $fillable = ['customer_id', 'affiliate_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }
}
