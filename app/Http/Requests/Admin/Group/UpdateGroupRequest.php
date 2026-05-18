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
            "group_number" => "required|string|max:255"

        ];
    }
}
