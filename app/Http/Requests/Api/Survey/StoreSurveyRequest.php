<?php

namespace App\Http\Requests\Api\Survey;

use App\Http\Requests\BaseRequest;

class StoreSurveyRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'survey_id' => 'required|exists:surveys,id',
            'brand_id' => 'required|exists:brands,id',
            'questions' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'survey_id.required' => __('validation.survey_id_required'),
            'survey_id.exists' => __('validation.survey_id_exists'),
            'brand_id.required' => __('validation.brand_id_required'),
            'brand_id.exists' => __('validation.brand_id_exists'),
            'questions.required' => __('validation.questions_required'),
            'questions.array' => __('validation.questions_array'),
        ];
    }

}
