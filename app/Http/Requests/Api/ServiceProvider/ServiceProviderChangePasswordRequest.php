<?php

namespace App\Http\Requests\Api\ServiceProvider;

use App\Http\Requests\BaseRequest;

class ServiceProviderChangePasswordRequest extends BaseRequest
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
            'id'=>'required|numeric|exists:service_providers',
            'password'=>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => __('validation.id'),
            'id.numeric' => __('validation.numeric'),
            'id.exists' => __('validation.no_account_id'),
            'password.required'=>__('validation.password'),
            'password.min'=>__('validation.min_password'),
        ];
    }
}
