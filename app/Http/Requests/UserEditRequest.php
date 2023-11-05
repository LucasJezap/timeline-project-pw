<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Username is required!',
        ];
    }
}
