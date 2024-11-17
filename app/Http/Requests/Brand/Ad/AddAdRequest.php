<?php

namespace App\Http\Requests\Brand\Ad;

use App\Http\Requests\AdminBaseRequest;

class AddAdRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'=>  'required',
            'image'=>  'required',
        ];
    }

    public function messages(): array
    {
        return  [
            'title.required' => __('validation.title_required'),
            'image.required' => __('validation.image_required'),
        ];
    }
}
