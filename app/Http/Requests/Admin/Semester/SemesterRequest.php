<?php

namespace App\Http\Requests\Admin\Semester;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SemesterRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "start_date" => "nullable|date",
            "end_date" => "nullable|date"
        ];
    }
}
