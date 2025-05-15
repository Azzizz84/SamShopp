<?php

namespace App\Http\Requests\Api\Section;

use App\Http\Requests\BaseRequest;

class CreateSectionRequest extends BaseRequest
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
            'title'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => __('validation.title'),
        ];
    }
}
