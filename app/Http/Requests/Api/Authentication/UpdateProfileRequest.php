<?php

namespace App\Http\Requests\Api\Authentication;

use App\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.name_required'),
            'city_id.required' => __('validation.city_id_required'),
            'city_id.exists' => __('validation.city_id_exists'),
        ];
    }

}
