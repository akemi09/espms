<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email:filter|string|unique:users,email,'.$this->user->id,
            'roles' => 'required',
            'password' => 'sometimes|nullable|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'roles' => 'Please select a user roles',
        ];
    }
}
