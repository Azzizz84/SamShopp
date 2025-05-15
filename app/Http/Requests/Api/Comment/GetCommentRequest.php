<?php

namespace App\Http\Requests\Api\Comment;

use App\Http\Requests\BaseRequest;

class GetCommentRequest extends BaseRequest
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
            'market_id'=>'required|numeric|exists:markets,id',
        ];
    }
    public function messages()
    {
        return [
            'market_id.required' => __('validation.market_id'),
            'market_id.numeric' => __('validation.numeric'),
            'market_id.exists' => __('validation.market_exists'),

        ];
    }
}
