<?php


namespace app\Http\Requests\Admin\Group;

use Illuminate\Foundation\Http\FormRequest;



class GroupRequest extends FormRequest
{
    public function rules(): array
        {
            return [
                "name" => "required",
                "departament_id" => 'required|exists:departaments,id',
                "student_count" => "nullable|integer|min:0"

            ];
        }
}