<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class ChangeStatusRequest extends BaseRequest
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
            'status'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'status.required'=>__('validation.status'),
        ];
    }
}
