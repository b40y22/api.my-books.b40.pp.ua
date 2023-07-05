<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.min' => trans('auth.name.min'),
            'name.required' => trans('auth.name.required'),
            'email.email' => trans('auth.email.email'),
            'email.required' => trans('auth.email.required'),
            'email.unique' => trans('auth.email.unique'),
            'password.confirmed' => trans('auth.password.confirmed'),
            'password.min' => trans('auth.password.min'),
            'password.required' => trans('auth.password.required'),
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->makeJsonResponse($validator);
    }
}
