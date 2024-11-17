<?php

namespace App\Http\Requests\Api\Survey;

use App\Http\Requests\BaseRequest;

class StoreRateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
//            'survey_id' => 'required|exists:surveys,id',
            'brand_id' => 'required|exists:brands,id',
            'rate' => 'required|between:1,5',
        ];
    }
    public function messages(): array
    {
        return [
            'brand_id.required' => __('validation.brand_id_required'),
            'brand_id.exists' => __('validation.brand_id_exists'),
            'rate.required' => __('validation.rate_required'),
            'rate.between' => __('validation.rate_between'),
        ];
    }
}
