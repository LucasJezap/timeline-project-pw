<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'start_date' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required!',
            'start_date.required' => 'Start Date is required!'
        ];
    }
}
