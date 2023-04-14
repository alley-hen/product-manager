<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5','string', Rule::unique('categories', 'name')->ignore($this->id)],
            'meta_title' => ['required', 'min:5','string'],
            'meta_description' => ['required', 'min:5','string'],
            'meta_keywords' => ['required', 'min:5','string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please complete this field.',
            'name.min:5' => 'The category name should be at least five characters.',
            'meta_title.required' => 'Please complete this field.',
            'meta_title.min:5' => 'The meta title should be at least five characters.',
            'meta_description.required' => 'Please complete this field.',
            'meta_description.min:5' => 'The description should be at least five characters.',
            'meta_keywords.required' => 'Please complete this field.',
            'meta_keywords.min:5' => 'The keywords should be at least five characters.',
        ];
    }
}
