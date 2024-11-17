<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\AdminBaseRequest;

class StoreCategoryRequest extends AdminBaseRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'name_ar.required' => 'الاسم بالعربية مطلوب',
            'name_en.required' => 'الاسم بالانجليزية مطلوب',
        ];
    }
}
