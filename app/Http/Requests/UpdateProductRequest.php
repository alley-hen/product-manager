<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required',  'min:5', 'string', Rule::unique('products', 'name')->ignore($this->id)],
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
