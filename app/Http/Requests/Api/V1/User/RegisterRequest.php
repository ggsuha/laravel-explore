<?php

namespace App\Http\Requests\Api\V1\User;

use App\Infrastructure\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|unique:users,email|email|max:125',
            'name' => 'required|string',
            'password' => 'required|min:8|max:125',
            'password_confirmation' => 'required|same:password|min:8|max:125',
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
