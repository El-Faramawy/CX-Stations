<?php

namespace App\Http\Requests\Admin\Country;

use App\Http\Requests\AdminBaseRequest;

class StoreCountryRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required',
            'name_en' => 'required',
            'code' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => 'الاسم بالعربية مطلوب',
            'name_en.required' => 'الاسم بالانجليزية مطلوب',
            'code.required' => 'الكود مطلوب',
        ];
    }
}
