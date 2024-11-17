<?php

namespace App\Http\Requests\Admin\City;

use App\Http\Requests\AdminBaseRequest;

class StoreCityRequest extends AdminBaseRequest
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
            'country_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => 'الاسم بالعربية مطلوب',
            'name_en.required' => 'الاسم بالانجليزية مطلوب',
            'country_id.required' => 'الدولة مطلوبة',
            'latitude.required' => 'خط الطول مطلوب',
            'longitude.required' => 'دائرة العرض مطلوب',
        ];
    }
}
