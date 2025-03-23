<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Supplier extends Model
{
    use HasFactory;
    protected $fillable=['name','contact_email','contact_phone','company_name','address'];

    public function medicines(){
        $this->hasMany(Medicine::class);
    }

}
