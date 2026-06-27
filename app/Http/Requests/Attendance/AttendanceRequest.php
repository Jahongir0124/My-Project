<?php

namespace App\Http\Requests\Attendance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            
            "course_id" => "required|integer|exists:courses,id",
            "students" => "nullable|array|min:0",
            "theme" => "nullable|string",
            "day" => "required|date",
            
        ];
    }
}
