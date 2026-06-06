<?php

namespace App\Http\Requests\Admin\Schedule;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
   




    public function rules(): array
    {
        return [

            "group_id" => "required|integer|exists:groups,id",
            "semester_id" => "required|integer|exists:semesters,id",
            "course_id" => "required|integer|exists:courses,id",
            "teacher_id" => "required|integer|exists:teachers,id",
            "day" => "required|string",
            "start_time" => "required|date_format:H:i",
            "end_time" => "required|date_format:H:i"
        ];
    }
}
