<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $table = "orders";


    public function payment(){
        return $this->hasOne(payment::class , 'order_id' );
    }






    public function scopeUsersPays($query){
        return $query->where('ComponyOrUser' , 'u');
        
    }


    public function scopeHasPayment($query){
        if(!is_null($this->payment)){
            return $query;
        }
    }
}
