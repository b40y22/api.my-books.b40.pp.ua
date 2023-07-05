<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Src\Dto\Auth\LoginDto;
use App\Src\Traits\ValidationJsonResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    use ValidationJsonResponseTrait;

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

    /**
     * @return LoginDto
     */
    public function validatedDTO(): LoginDto
    {
        return new LoginDto($this->validated());
    }
}
