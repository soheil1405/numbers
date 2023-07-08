<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storefieldsOfStudies extends FormRequest
{
    
    public function rules()
    {
        return [
    
            "rate"=>'required' ,
            "name"=>"required" ,
            "parent_id"=>"required" 
        ];
    }
}
