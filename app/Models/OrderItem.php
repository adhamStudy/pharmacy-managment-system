<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
   use HasFactory;

   protected $fillable =[
    'order_id',
    'medicine_id',
    'quantity',
    'price',
    'total'
   ];
   public function order(){
    return $this->belongsTo(Order::class);
   }
   public function medicine(){
    return $this->belongsTo(Medicine::class);
   }
}
