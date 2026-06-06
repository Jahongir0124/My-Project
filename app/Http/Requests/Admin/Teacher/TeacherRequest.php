<?php

namespace App\Http\Requests\Admin\Teacher;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:teachers,id",         
            "first_name" => "required|string|max:50",
            "last_name" => "required|string|max:50",
            "phone" => "required|string|max:30",
        ];
    }
}
