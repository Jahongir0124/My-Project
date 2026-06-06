<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
  
    public function rules(): array
    {
        return [
            
            "name" => "required|string|unique:users,name",
            "email" => "required|string|unique:users,email",
            "password" => "required|string|min:6|confirmed",
            "first_name" => "required|string|max:100",
            "last_name" => "required|string|max:100",
            "patrnomic" => "required|string|max:100",
            "group_id" => "required|integer|exists:groups,id"
        ];
    }
}
