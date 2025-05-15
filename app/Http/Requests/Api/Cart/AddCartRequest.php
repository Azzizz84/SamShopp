<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\BaseRequest;

class AddCartRequest extends BaseRequest
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
            'product_id'=>'required|numeric|exists:products,id',
            'quantity'=>'required|numeric',
            'market_id'=>'required|numeric|exists:markets,id',
        ];
    }
    public function messages()
    {
        return [
            'product_id.numeric' => __('validation.numeric'),
            'product_id.exists' => __('validation.product_exists'),
            'quantity.required' => __('validation.quantity'),
            'quantity.numeric' => __('validation.numeric'),
            'product_id.required' => __('validation.product_id'),
            'market_id.required' => __('validation.market_id'),
            'market_id.numeric' => __('validation.numeric'),
            'market_id.exists' => __('validation.market_exists'),
        ];
    }
}
