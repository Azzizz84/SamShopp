<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Requests\BaseRequest;

class EditAddressRequest extends BaseRequest
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
            'id'=>'required|numeric|exists:addresses',
            'city_id'=>'required|numeric|exists:cities,id',
            'lat'=>'required',
            'lng'=>'required',
            'address_title'=>'required',
            'recipient_name'=>'required',
            'recipient_phone'=>'required',
            'address'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'id.numeric' => __('validation.numeric'),
            'id.exists' => __('validation.address_exists'),
            'id.required' => __('validation.address_id'),
            'city_id.numeric' => __('validation.numeric'),
            'city_id.exists' => __('validation.city_exists'),
            'city_id.required' => __('validation.city_id'),
            'lat.required' => __('validation.lat'),
            'lng.required' => __('validation.lng'),
            'address_title.required' => __('validation.address_title'),
            'recipient_name.required' => __('validation.recipient_name'),
            'recipient_phone.required' => __('validation.recipient_phone'),
            'address.required' => __('validation.address'),
        ];
    }
}
