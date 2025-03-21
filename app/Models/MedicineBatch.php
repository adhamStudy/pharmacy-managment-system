<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicineBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicine_id', 'batch_code', 'registered_qty', 'sold_qty', 'remain_qty',
        'registered_date', 'expiry_date', 'selling_price', 'profit', 'remark'
    ];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
