<?php

namespace App\Models\auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authverifyNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code'
    ];


    protected $table = "authverify_numbers";


}
