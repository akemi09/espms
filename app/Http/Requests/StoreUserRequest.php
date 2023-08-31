<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
            'email' => 'required|email:filter|max:250|unique:users',
            'roles' => 'required',
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'roles' => 'Please select a user roles',
        ];
    }
}
