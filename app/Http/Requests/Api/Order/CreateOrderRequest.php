<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\BaseRequest;

class CreateOrderRequest extends BaseRequest
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
            'address_id'=>'required|numeric|exists:addresses,id',
        ];
    }
    public function messages()
    {
        return [
            'address_id.numeric' => __('validation.numeric'),
            'address_id.exists' => __('validation.address_exists'),
            'address_id.required' => __('validation.address_id'),
        ];
    }
}
