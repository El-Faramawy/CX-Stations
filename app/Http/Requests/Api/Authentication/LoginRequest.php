<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'=>'required',
            'password'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation.email_required'),
            'password.required' => __('validation.password_required'),
        ];
    }
}
