<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class CheckCodeRequest extends BaseRequest
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
            'code'=>'required',
            'hashed_code'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'code.required' => __('validation.code'),
            'hashed_code.required' => __('validation.code'),
        ];
    }
}
