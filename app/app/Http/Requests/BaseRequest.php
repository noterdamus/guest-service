<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $validatorException = new ValidationException($validator);

        $errors = Arr::flatten($validatorException->errors());

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
