<?php

namespace App\Http\Requests\Exam;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
  
    public function rules(): array
    {
        return [

            "course_id" => "required|integer|exists:courses,id",
            "name" => "required|string|max:255",
            "type" => "required|string",
            "time" => "nullable|integer",
            'score' => 'required|integer',
            "count_question" => "required|integer",
            "date_of_exam" => "required|date"

        ];
    }
}
