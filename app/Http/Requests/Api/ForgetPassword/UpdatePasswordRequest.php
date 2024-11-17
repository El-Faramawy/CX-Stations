<?php

namespace App\Http\Requests\Api\ForgetPassword;

use App\Http\Requests\BaseRequest;

class UpdatePasswordRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => __('validation.email_required'),
            'email.exists' => __('validation.email_exists'),
            'password.required' => __('validation.password_required'),
        ];
    }

}
