<?php

namespace App\Http\Requests\Brand\ForgetPassword;

use App\Http\Requests\AdminBaseRequest;

class UpdatePasswordRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|exists:brands,email',
            'password' => 'required_with:confirm_password|same:confirm_password|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'confirm_password' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => __('validation.email_required'),
            'email.exists' => __('validation.email_exists'),
            'password.required_with' => __('validation.password_required_with'),
            'password.same' => __('validation.password_same'),
            'password.min' => __('validation.password_min'),
            'password.regex' => __('validation.password_help'),
            'confirm_password.required' => __('validation.confirm_password_required'),
        ];
    }
}
