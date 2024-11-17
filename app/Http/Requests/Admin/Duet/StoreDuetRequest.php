<?php

namespace App\Http\Requests\Admin\Duet;

use App\Http\Requests\AdminBaseRequest;

class StoreDuetRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand1_id' => 'required',
            'brand2_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'brand1_discount' => 'required',
            'brand2_discount' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'brand1_id.required' => 'براند 1 مطلوب',
            'brand2_id.required' => 'براند 2 مطلوب',
            'start_date.required' => 'تاريخ البداية مطلوب',
            'end_date.required' => 'تاريخ النهاية مطلوب',
            'brand1_discount.required' => 'خصم براند 1 مطلوب',
            'brand2_discount.required' => 'خصم براند 2 مطلوب',
        ];
    }
}
