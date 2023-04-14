<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:products,name', 'min:5', 'string'],
            'slug' => ['required', 'min:5', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please complete this field.',
            'name.min:5' => 'The name should be at least five characters.',
            'slug.required' => 'Please complete this field.',
            'slug.min:5' => 'The slug should be at least five characters.',
        ];
    }
}
