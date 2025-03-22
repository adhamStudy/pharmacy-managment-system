<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class MedicineBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicine_id', 'batch_code', 'registered_qty', 'sold_qty', 'remain_qty',
        'registered_date', 'expiry_date', 'selling_price', 'profit', 'remark','status'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }
    public function updateStatus(){
        $now=Carbon::now();
        $threeMonthFromNow=$now->addMonth(3);
        if ($this->expiry_date <=$now){
            $this->status='passive';
        }
        elseif ($this->expiry_date <=$threeMonthFromNow)
        {
            $this->status='passive';
        }
        else{
            $this->status='active';
        }

        $this->save();

    }
}
