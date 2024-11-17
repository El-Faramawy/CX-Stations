<?php

namespace App\Http\Requests;

use App\Http\Traits\PaginateTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    use PaginateTrait;
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->apiResponse(null,$validator->errors()->first(),'simple','422')
        );
    }
}
