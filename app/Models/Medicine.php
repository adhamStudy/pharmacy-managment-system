<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'category', 'status'];

    

    public function batches(){
        return $this->hasMany(MedicineBatch::class, 'medicine_id', 'id'); 

    }
    
}
