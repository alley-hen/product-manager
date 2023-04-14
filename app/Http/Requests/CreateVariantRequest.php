<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['integer','required'],
            'sap_product_code' => ['required', 'min:5', 'string'],
            'web_product_code' => ['required', 'min:5', 'string'],
            'name' => ['required', 'min:5', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please complete this field.',
            'name.min:5' => 'The name should be at least five characters.',
            'sap_product_code.required' => 'Please complete this field.',
            'sap_product_code.min:5' => 'The code should be at least five characters.',
            'web_product_code.required' => 'Please complete this field.',
            'web_product_code.min:5' => 'The code should be at least five characters.',
        ];
    }
}
