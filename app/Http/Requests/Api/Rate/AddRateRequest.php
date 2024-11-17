<?php

namespace App\Http\Requests\Api\Rate;

use App\Http\Requests\BaseRequest;

class AddRateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
//            'comment' => 'required',
            'rate' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => __('validation.user_id_required'),
            'user_id.exists' => __('validation.user_id_exists'),
//            'comment.required' => __('validation.comment_required'),
            'rate.required' => __('validation.rate_required'),
        ];
    }
}
