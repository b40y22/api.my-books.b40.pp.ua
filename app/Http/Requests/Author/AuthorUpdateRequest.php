<?php
declare(strict_types=1);

namespace App\Http\Requests\Author;

use App\Dto\Author\AuthorUpdateDto;
use App\Traits\ErrorResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthorUpdateRequest extends FormRequest
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
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'firstname.required' => trans('api.field.required'),
            'firstname.min' => trans('api.firstname.min'),
            'lastname.required' => trans('api.field.required'),
            'lastname.min' => trans('api.lastname.min'),
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
     * @return AuthorUpdateDto
     */
    public function validatedDTO(): AuthorUpdateDto
    {
        return new AuthorUpdateDto($this->validated());
    }
}
