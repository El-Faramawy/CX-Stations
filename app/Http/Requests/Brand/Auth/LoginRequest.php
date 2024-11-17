<?php

namespace App\Http\Requests\Brand\Auth;

use App\Http\Requests\AdminBaseRequest;

class LoginRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'=>  'required | exists:brands,email',
            'password'=>  'required',
        ];
    }

    public function messages(): array
    {
        return  [
            'email.required' => __('validation.email_required'),
            'email.exists' => __('validation.email_exists'),
            'password.required' => __('validation.password_required'),
        ];
    }
}
