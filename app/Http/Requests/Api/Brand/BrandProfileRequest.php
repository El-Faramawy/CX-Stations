<?php

namespace App\Http\Requests\Api\Brand;

use App\Http\Requests\BaseRequest;

class BrandProfileRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
        ];
    }
    public function messages(): array
    {
        return [
            'brand_id.required' => __('validation.brand_id_required'),
            'brand_id.exists' => __('validation.brand_id_exists'),
        ];
    }
}
