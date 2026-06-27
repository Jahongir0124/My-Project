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
            "group_id" => "required|int|exists:groups,id",
            'semester_id' => "required|integer|exists:semesters,id",
            "teacher_id" => "required|integer|exists:teachers,id",
            "score_course" => "required|integer",
            "description" => "nullable|string",
            "is_active" => "nullable|boolean"
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active')
        ]);
    }
}
