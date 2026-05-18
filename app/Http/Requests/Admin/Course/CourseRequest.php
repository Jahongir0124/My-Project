<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "departament_id" => "required|int|exists:departaments,id",
            "score" => "nullable|int",
            "description" => "nullable|string",
            "is_active" => "nullable|bool"
        ];
    }
}
