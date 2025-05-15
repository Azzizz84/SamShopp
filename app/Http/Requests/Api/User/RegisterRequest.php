<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
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
            'phone'=>'required|numeric|unique:users',
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6',
            'token'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'token.required'=>__('validation.token'),
            'phone.required' => __('validation.phone'),
            'phone.numeric' => __('validation.numeric'),
            'phone.unique' => __('validation.unique_phone'),
            'email.unique' => __('validation.unique_email'),
            'email.email' => __('validation.correct_email'),
            'password.required' => __('validation.password'),
            'password.min'=>__('validation.min_password'),
            'email.required' => __('validation.email'),
            'name.required' => __('validation.name'),
        ];
    }
}
