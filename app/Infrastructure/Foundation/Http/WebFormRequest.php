<?php

namespace App\Infrastructure\Foundation\Http;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

abstract class WebFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $exception = (new ValidationException($validator))
                        ->errorBag($this->errorBag)
                        ->redirectTo($this->getRedirectUrl());

        if ($this->expectsJson()) {
            throw $exception->status(Response::HTTP_OK);
        }

        throw $exception;
    }
}
