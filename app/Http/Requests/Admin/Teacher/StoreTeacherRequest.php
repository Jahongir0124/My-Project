<?php

namespace App\Http\Requests\Admin\Teacher;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
  
    public function rules(): array
    {
        return [
            "name" => "required|string|unique:users,name",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6|confirmed",
            "first_name" => "required|string|max:50",
            "last_name" => "required|string|max:50",
            "departament_id" => "required|integer|exists:departaments,id",
            "patnynomic" => "required|string|max:50",
            "specialization" => "required|string|max:255",
            "phone" => "required|string|max:30",
        ];
    }
}
