<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Override;

class ChanngePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
            'new_password' => ['required', Password::min(8)]
        ];
    }


    #[Override]
    public function messages()
    {
        return [
            'password' => "Joriy parol xato",
            'new_password' => "Yangi parol uzunligi minimal 8 te belgi bo'lishi zarur"
        ];
    }
}
