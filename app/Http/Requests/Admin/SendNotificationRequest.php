<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminBaseRequest;

class SendNotificationRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'required ',
            'title' => 'required',
        ];
    }

    public function messages(): array
    {
        return  [
            'title.required' => 'عنوان الرسالة مطلوب',
            'message.required' => ' الرسالة مطلوبة',
        ];
    }
}
