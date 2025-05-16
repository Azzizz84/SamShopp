<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseRequest;

class CheckPhoneRequest extends BaseRequest
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
            'phone' => [
            'required',
            'regex:/^(\+967|967|0)?[1-9]\d{8}$/' // Accepts: +967XXXXXXX, 967XXXXXXX, 0XXXXXXX
        ]
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
