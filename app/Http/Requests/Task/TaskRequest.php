<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
  
    public function rules(): array
    {
        return [

            "schedule_id" => "required|integer|exists:schedules,id",
            "name" => "required|string|max:200",
            "deadline" => "required|date",
            "score" => "nullable|integer",
            "file" => "nullable|file|mimes:docx,pdf,xlsx|max:5120"
        ];
    }
}
