<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storenames extends FormRequest
{

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'persian_name'=>'required' , 'english_name'=>'required'
        ];
    }
}
