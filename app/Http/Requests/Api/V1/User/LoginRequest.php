<?php

namespace App\Http\Requests\Api\V1\User;

use App\Infrastructure\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * Get user input data.
     *
     * @return array<string, mixed>
     */
    public function getUserData(): array
    {
        return [
            'email' => $this->input('email'),
            'name' => $this->input('name'),
            'password' => $this->input('password'),
        ];
    }
}
