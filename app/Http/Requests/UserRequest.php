<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
   
   
    public function rules(): array
    {
        return [
            
            "name" => "required|unique:users,name|string|max:30",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6|confirmed",
        ];
    }
}
