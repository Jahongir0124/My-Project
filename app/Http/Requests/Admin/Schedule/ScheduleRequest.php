<?php

namespace App\Http\Requests\Admin\Schedule;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "group_semester_id" => "required|integer|exists:group_semesters,id",
            "course_id" => "required|integer|exists:courses,id",
            "day_id" => "required|integer|exists:days,id",
            "pair_id" => "required|integer|exists:pairs,id"
        ];
    }
}
