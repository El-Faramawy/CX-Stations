<?php

namespace App\Http\Requests\Admin\Question;

use App\Http\Requests\AdminBaseRequest;

class StoreQuestionRequest extends AdminBaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'question_ar' => 'required',
            'question_en' => 'required',
            'question_answers' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'القسم مطلوب',
            'question_ar.required' => 'السؤال بالعربية مطلوب',
            'question_en.required' => 'السؤال بالانجليزية مطلوب',
            'question_answers.required' => 'الاجابات مطلوبة',
        ];
    }
}
