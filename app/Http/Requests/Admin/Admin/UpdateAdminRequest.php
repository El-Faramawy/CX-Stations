<?php

namespace App\Http\Requests\Admin\Admin;

use App\Http\Requests\AdminBaseRequest;

class UpdateAdminRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required | unique:admins,email,' . request()->route('admin')->id,
            'name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'email.unique' => 'اسم المستخدم موجود مسبقا',
            'email.required' => ' اسم المستخدم مطلوب',
        ];
    }

}
