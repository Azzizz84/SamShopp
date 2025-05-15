<?php

namespace App\Http\Requests\Api\ServiceProvider;

use App\Http\Requests\BaseRequest;

class ServiceProviderCanRegisterRequest extends BaseRequest
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
            'phone'=>'required|numeric|unique:service_providers',
            'email'=>'required|unique:service_providers|email',
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => __('validation.phone'),
            'phone.numeric' => __('validation.numeric'),
            'phone.unique' => __('validation.unique_phone'),
            'email.unique' => __('validation.unique_email'),
            'email.email' => __('validation.correct_email'),
            'email.required' => __('validation.email'),
        ];
    }
}
