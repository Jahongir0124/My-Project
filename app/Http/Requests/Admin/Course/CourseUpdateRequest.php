<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            
            "id" => "required|integer|exists:courses,id",
            "name" => "required|string|max:255",
            "score_course" => "nullable|integer",
            "is_active" => "nullable|bool",
            "description" => "nullable|string"
        ];
    }
}
