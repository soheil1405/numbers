<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_roles extends Model
{
    use HasFactory ;
    protected $table = "user_roles";

    protected $fillable = [
        'user_id',
        'role_id', 
        'deleted_at' ,
    ];



    public function role(){
        return $this->belongsTo(Rols::class);
    }

    public function users(){
        return $this->belongsTo(User::class , 'user_id');
    }
    
}
