<?php

namespace App\Http\Requests\Admin\Auth;

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
            'email'=>  'required | exists:admins,email',
            'password'=>  'required',
        ];
    }

    public function messages(): array
    {
        return  [
        ];
    }
}
