<?php

namespace App\Http\Requests\Api\Contact;

use App\Http\Requests\BaseRequest;

class ContactRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'message.required' => __('validation.message_required'),
        ];
    }

}
