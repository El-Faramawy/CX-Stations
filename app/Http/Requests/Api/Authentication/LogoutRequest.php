<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\BaseRequest;

class LogoutRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => __('validation.token_required'),
        ];
    }

}
