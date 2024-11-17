<?php

namespace App\Http\Requests\Brand\Auth;

use App\Http\Requests\AdminBaseRequest;

class RegisterRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:brands,email',
            'phone' => 'required|unique:brands,phone|min:9',
            'commercial_number' => 'required|unique:brands,commercial_number',
            'city_id' => 'required|exists:cities,id',
            'category_id' => 'required|exists:categories,id',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ];
    }

    public function messages(): array
    {
        return  [
            'name.required' => __('validation.name_required'),
            'email.required' => __('validation.email_required'),
            'email.unique' => __('validation.email_unique'),
            'phone.required' => __('validation.phone_required'),
            'phone.unique' => __('validation.phone_unique'),
            'phone.min' => __('validation.phone_min'),
            'commercial_number.required' => __('validation.commercial_number_required'),
            'commercial_number.unique' => __('validation.commercial_number_unique'),
            'city_id.required' => __('validation.city_id_required'),
            'city_id.exists' => __('validation.city_id_exists'),
            'category_id.required' => __('validation.category_id_required'),
            'category_id.exists' => __('validation.category_id_exists'),
            'password.required' => __('validation.password_required'),
            'password.min' => __('validation.password_min'),
            'password.regex' => __('validation.password_help'),
        ];
    }
}
