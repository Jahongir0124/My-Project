<?php

namespace App\Http\Requests\Admin\Group;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [

            "id" => "required|int",
            "name" => "required|string|max:255",
            "student_count" => "required|integer"

        ];
    }
}
