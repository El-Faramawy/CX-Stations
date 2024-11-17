<?php

namespace App\Http\Requests\Admin\Answer;

use App\Http\Requests\AdminBaseRequest;

class StoreAnswerRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'answer_ar' => 'required',
            'answer_en' => 'required',
            'percentage' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'answer_ar.required' => 'الاجابة بالعربية مطلوبة',
            'answer_en.required' => 'الاجابة بالانجليزية مطلوبة',
            'percentage.required' => 'النسبة مطلوبة',
        ];
    }
}
