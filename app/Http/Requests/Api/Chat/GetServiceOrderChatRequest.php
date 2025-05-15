<?php

namespace App\Http\Requests\Api\Chat;

use App\Http\Requests\BaseRequest;

class GetServiceOrderChatRequest extends BaseRequest
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
            'id'=>'required|numeric|exists:service_orders',
//            'delivery_id'=>'required|numeric|exists:deliveries',
        ];
    }
    public function messages()
    {
        return [
            'id.numeric' => __('validation.numeric'),
            'id.exists' => __('validation.order_exists'),
            'id.required' => __('validation.order'),
//            'delivery_id.numeric' => __('validation.numeric'),
//            'delivery_id.exists' => __('validation.delivery_exists'),
//            'delivery_id.required' => __('validation.delivery'),
        ];
    }
}
