<?php

namespace App\Http\Requests\Api\ServiceOrder;

use App\Http\Requests\BaseRequest;

class CreateServiceOrderOfferRequest extends BaseRequest
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
            'service_order_id'=>'required|numeric|exists:service_orders,id',
            'price'=>'required|numeric',
            'description'=>'required',
            'time'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'service_order_id.numeric' => __('validation.numeric'),
            'service_order_id.exists' => __('validation.order_exists'),
            'service_order_id.required' => __('validation.order'),
            'description.required' => __('validation.description'),
            'time.required' => __('validation.time'),
            'price.required' => __('validation.price'),
            'price.numeric' => __('validation.numeric'),
        ];
    }
}
