<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'device_ip' => 'required|unique:users,device_ip',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'password' => 'required',
            'age' => 'integer',
            'fcm_token' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.name_required'),
            'email.required' => __('validation.email_required'),
            'email.unique' => __('validation.email_unique'),
            'phone.required' => __('validation.phone_required'),
            'phone.unique' => __('validation.phone_unique'),
            'device_ip.required' => __('validation.device_ip_required'),
            'device_ip.unique' => __('validation.device_ip_unique'),
            'city_id.required' => __('validation.city_id_required'),
            'city_id.exists' => __('validation.city_id_exists'),
            'country_id.required' => __('validation.country_id_required'),
            'country_id.exists' => __('validation.country_id_exists'),
            'category_id.required' => __('validation.category_id_required'),
            'category_id.exists' => __('validation.category_id_exists'),
            'password.required' => __('validation.password_required'),
            'age.integer' => __('validation.age_integer'),
            'fcm_token.required' => __('validation.fcm_token_required'),
        ];
    }
}
