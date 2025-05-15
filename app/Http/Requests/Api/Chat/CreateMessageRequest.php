<?php

namespace App\Http\Requests\Api\Chat;

use App\Http\Requests\BaseRequest;

class CreateMessageRequest extends BaseRequest
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
            'chat_id'=>'required|numeric',
            'message'=>'required',
            'from'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'chat_id.numeric' => __('validation.numeric'),
            'chat_id.required' => __('validation.order'),
            'message.required' => __('validation.message'),
            'from.required' => __('validation.from'),
        ];
    }
}
