<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
  
    public function rules(): array
    {
        return [

            "course_id" => "required|integer|exists:courses,id",
            "name" => "required|string|max:200",
            "deadline" => "required|date",
            "score" => "nullable|integer",
            "file" => "nullable|file|mimes:docx,pdf,xlsx|max:5120"
        ];
    }
}
