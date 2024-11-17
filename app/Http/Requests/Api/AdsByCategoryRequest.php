<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class AdsByCategoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'category_id.required' => __('validation.category_id_required'),
        ];
    }

}
