<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 
        'medicine_id', 
        'batch_id',  // Add this line
        'quantity', 
        'price', 
        'total'
    ];

    // Relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with Medicine
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    // New relationship with MedicineBatch
    public function medicineBatch()
    {
        return $this->belongsTo(MedicineBatch::class, 'batch_id');
    }
}