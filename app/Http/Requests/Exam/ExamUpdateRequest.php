<?php

namespace App\Http\Requests\Exam;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            
            "id" => "required|integer|exists:exams,id",
            "name" => "required|string|max:255",
            "type" => "required|string",
            "count_question" => "required|integer",
            "time" => "required|integer",
            "date_of_exam" => "required|date"
        ];
    }
}
