<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\BaseRequest;

class UpdateOrderRequest extends BaseRequest
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
            'id'=>'required|numeric|exists:orders',
            'status'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'id.numeric' => __('validation.numeric'),
            'id.exists' => __('validation.order_exists'),
            'id.required' => __('validation.order'),
            'status.required' => __('validation.status'),
        ];
    }
}
