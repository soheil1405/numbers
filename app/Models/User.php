<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\auth\authverifyCode;
use App\Models\auth\authverifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'mobile',
        'componyName',
        'mobile_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function rolation()
    {
        return $this->hasOne(user_roles::class);
    }


    public function role()
    {
        return $this->hasOne(user_roles::class);
    }

    public function Payments(){
        return $this->hasMany(payment::class , 'user_id')->latest();
    }
    public function orders(){
        return $this->hasMany(orders::class , 'user_id')->latest();
    }


    public function orgHistory(){
        return $this->hasMany(orders::class)->where('resultCount' , '>' , "1")->where('status' , '100')->latest();
    }

    public function personalHistory(){
        return $this->hasMany(orders::class)->where('resultCount'  , "1")->latest();
    }




}
