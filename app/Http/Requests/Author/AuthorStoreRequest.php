<?php
declare(strict_types=1);

namespace App\Http\Requests\Author;

use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Traits\ErrorResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthorStoreRequest extends FormRequest
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
            'user_id' => 'required|numeric',
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
            'user_id.required' => trans('api.general.failed'),
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
     * @return AuthorStoreDto
     */
    public function validatedDTO(): AuthorStoreDto
    {
        return new AuthorStoreDto($this->validated());
    }
}
