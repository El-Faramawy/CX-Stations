<?php

namespace App\Http\Requests\Admin\Profile;

use App\Http\Requests\AdminBaseRequest;

class UpdateProfileRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required | unique:admins,email,' . admin()->id(),
            'name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'email.unique' => 'هذا البريد الالكترونى موجود مسبقا',
            'email.required' => ' البريد الالكترونى مطلوب',
        ];
    }
}
