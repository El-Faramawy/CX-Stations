<?php

namespace App\Http\Requests\Admin\Admin;

use App\Http\Requests\AdminBaseRequest;

class StoreAdminRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required | unique:admins,email',
            'name' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return  [
            'name.required' => 'الاسم مطلوب',
            'email.unique' => 'هذا البريد الالكترونى موجود مسبقا',
            'email.required' => ' البريد الالكترونى مطلوب',
            'password.required' => ' كلمة المرور مطلوبة',
        ];
    }
}
