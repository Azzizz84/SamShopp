<?php

namespace App\Http\Requests\Api\ServiceProvider;

use App\Http\Requests\BaseRequest;

class ServiceProviderCheckPhoneRequest extends BaseRequest
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
            'phone'=>'required|numeric|exists:service_providers',
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => __('validation.phone'),
            'phone.numeric' => __('validation.numeric'),
            'phone.exists' => __('validation.no_account'),
        ];
    }
}
