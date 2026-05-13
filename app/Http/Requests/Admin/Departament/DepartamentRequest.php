<?php

namespace App\Http\Requests\Admin\Departament;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DepartamentRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            
            'name' => 'required|string|max:255'
        ];
    }
}
