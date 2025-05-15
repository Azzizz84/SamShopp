<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseRequest;

class ChargeWalletRequest extends BaseRequest
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
            'money'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'money.required'=>__('validation.money'),
            'money.numeric'=>__('validation.numeric'),
        ];
    }
}
