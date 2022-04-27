<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "employee_id" => ['required','unique:users'],
            "first_name" => ['required'],
            "last_name" => ['required'],
            "role" => ['required',Rule::exists('roles','name')],
            "email" => ['required','unique:users'],
            "mobile_number" => ['required','unique:users'],
            "username" => ['required','unique:users'],
            "password" => ['required','min:6','confirmed'],
            'permissions' => ['nullable','array']
        ];
    }
}
