<?php

namespace App\Http\Requests\Brand\ForgetPassword;

use App\Http\Requests\AdminBaseRequest;

class GetCodeRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|exists:brands,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('validation.email_required'),
            'email.exists' => __('validation.email_exists'),
        ];
    }
}
