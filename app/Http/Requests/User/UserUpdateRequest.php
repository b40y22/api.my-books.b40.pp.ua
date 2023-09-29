<?php
declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Dto\User\UserUpdateDto;
use App\Traits\ErrorResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserUpdateRequest extends FormRequest
{
    use ErrorResponseTrait;

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.min' => trans('api.field.min'),
            'email.email' => trans('api.field.email'),
            'email.min' => trans('api.field.min'),
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
     * @return UserUpdateDto
     */
    public function validatedDTO(): UserUpdateDto
    {
        return new UserUpdateDto($this->all());
    }

    /**
     * @param $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->route()->parameter('id') != auth()->id()) {
                $validator->errors()->add('id', trans('api.access.denied'));
            }
        });
    }
}
