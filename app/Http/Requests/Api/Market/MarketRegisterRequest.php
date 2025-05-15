<?php

namespace App\Http\Requests\Api\Market;

use App\Http\Requests\BaseRequest;

class MarketRegisterRequest extends BaseRequest
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
            'phone'=>'required|numeric|unique:markets',
            'name'=>'required',
            'description'=>'required',
            'email'=>'required|unique:markets|email',
            'password'=>'required|min:6',
//            'token'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'address'=>'required',
            'city_id'=>'required|numeric|exists:cities,id',
        ];
    }
    public function messages()
    {
        return [
//            'token.required'=>__('validation.token'),
            'description.required'=>__('validation.description'),
            'phone.required' => __('validation.phone'),
            'phone.numeric' => __('validation.numeric'),
            'phone.unique' => __('validation.unique_phone'),
            'email.unique' => __('validation.unique_email'),
            'email.email' => __('validation.correct_email'),
            'password.required' => __('validation.password'),
            'password.min'=>__('validation.min_password'),
            'email.required' => __('validation.email'),
            'name.required' => __('validation.name'),
            'lat.required' => __('validation.lat'),
            'lng.required' => __('validation.lng'),
            'address.required' => __('validation.address'),
            'city_id.numeric' => __('validation.numeric'),
            'city_id.exists' => __('validation.city_exists'),
            'city_id.required' => __('validation.city_id'),
        ];
    }
}
