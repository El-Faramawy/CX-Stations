<?php

namespace App\Http\Requests\Api\Ad;

use App\Http\Requests\BaseRequest;

class AdLikeRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ad_id' => 'required|exists:ads,id',
        ];
    }

    public function messages(): array
    {
        return [
            'ad_id.required' => __('validation.ad_id_required'),
            'ad_id.exists' => __('validation.ad_id_exists'),
        ];
    }

}
