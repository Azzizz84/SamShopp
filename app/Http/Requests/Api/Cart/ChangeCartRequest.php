<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\BaseRequest;

class ChangeCartRequest extends BaseRequest
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
            'id'=>'required|numeric|exists:carts',
        ];
    }
    public function messages()
    {
        return [
            'id.numeric' => __('validation.numeric'),
            'id.exists' => __('validation.cart_exists'),
            'id.required' => __('validation.cart'),
        ];
    }
}
