<?php

namespace App\Http\Requests;

use App\Traits\Restable;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    use Restable;

    /**
     * Get the response for a forbidden operation.
     *
     * @return \Illuminate\Http\JsonResponse The JSON-response
     */
    public function forbiddenResponse()
    {
        return $this->respondForbidden();
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array $errors
     *
     * @return \Illuminate\Http\JsonResponse The JSON-response
     */
    public function response(array $errors)
    {
        return $this->respondUnprocessableEntity($errors);
    }
}
