<?php

namespace App\Http\Requests\Admin\Schedule;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleUpdateRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:schedules,id",
            "teacher_id" => "required|integer|exists:teachers,id",
            "day" => "required|string",
            "start_time" => "required|date_format:H:i",
            "end_time" => "required|date_format:H:i"
        ];
    }
}
