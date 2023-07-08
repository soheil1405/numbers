<?php

namespace App\Models\auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authverifyCode extends Model
{
    use HasFactory ;

    protected $fillable = [
        'user_id',
        'code',
        'for'
    ];


    protected $table = "authverify_codes";


}
