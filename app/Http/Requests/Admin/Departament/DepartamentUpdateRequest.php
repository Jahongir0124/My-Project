<?php

namespace App\Http\Requests\Admin\Departament;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DepartamentUpdateRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
           
                "id" => "required|exists:departaments,id",
                "name" => "required|string"

        ];
    }
}
