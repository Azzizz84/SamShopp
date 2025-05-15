<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\BaseRequest;

class CreateProductRequest extends BaseRequest
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
            'title'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'section_id.numeric' => __('validation.numeric'),
            'section_id.exists' => __('validation.section_exists'),
            'section_id.required' => __('validation.section_id'),
            'title.required' => __('validation.title'),
            'description.required' => __('validation.description'),
            'price.required' => __('validation.price'),
            'price.numeric' => __('validation.numeric'),
        ];
    }
}
