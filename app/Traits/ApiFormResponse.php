<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiFormResponse
{
    use ApiResponser;
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException($this->errorResponse($validator->errors(), 422));
    }
}
