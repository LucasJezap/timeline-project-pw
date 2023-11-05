<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'email',
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Old password is required!',
            'new_password.required' => 'New password is required!'
        ];
    }
}
