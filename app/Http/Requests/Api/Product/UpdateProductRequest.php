<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\BaseRequest;

class UpdateProductRequest extends BaseRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section_id'=>'required|exists:sections,id|numeric',
            'id'=>'required|exists:products,id|numeric',
        ];
    }
    public function messages()
    {
        return [
            'section_id.numeric' => __('validation.numeric'),
            'section_id.exists' => __('validation.section_exists'),
            'section_id.required' => __('validation.section_id'),
            'id.numeric' => __('validation.numeric'),
            'id.exists' => __('validation.product_exists'),
            'id.required' => __('validation.product_id'),
        ];
    }
}
