<?php

namespace App\Http\Requests\Brand\ForgetPassword;

use App\Http\Requests\AdminBaseRequest;

class ConfirmCodeRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|exists:brands,email',
            'otp_code' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => __('validation.email_required'),
            'email.exists' => __('validation.email_exists'),
            'otp_code.required' => __('validation.otp_code_required'),
        ];
    }
}
