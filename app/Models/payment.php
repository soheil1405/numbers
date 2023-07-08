<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function order (){
        return $this->hasOne(Orders::class , 'payment_id');
    }



    public function users(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
