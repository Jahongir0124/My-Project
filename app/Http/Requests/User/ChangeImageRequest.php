<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ChangeImageRequest extends FormRequest
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
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg', 'max:5120']
        ];
    }


    #[Override]
    public function messages()
    {
        return [
            'image' =>
            'Kiritlayotgan format png,jpg,jeg bo\'lishi shart'
        ];
    }
}
