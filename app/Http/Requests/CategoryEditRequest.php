<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'string|max:2000',
            'color' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required!',
            'color.required' => 'Color is required!'
        ];
    }
}
