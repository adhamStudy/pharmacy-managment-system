<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'category', 'registered_qty', 'sold_qty', 'remain_qty',
        'registered_date', 'expiry_date', 'remark', 'selling_price', 'profit', 'status'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
