<?php

namespace App\Http\Requests\TaskAnswer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskAnswerRequest extends FormRequest
{
  
    public function rules(): array
    {
        return [

            "task_id" => "required|integer|exists:tasks,id",
            "file_answer" => "required|file|mimes:pdf,xlsx,docx,pptx,zip,rar|max:10240"
        ];
    }
}
