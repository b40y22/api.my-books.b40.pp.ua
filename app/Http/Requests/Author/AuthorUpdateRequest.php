<?php
declare(strict_types=1);

namespace App\Http\Requests\Author;

use App\Src\Dto\Author\AuthorUpdateDto;
use App\Src\Traits\ValidationJsonResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthorUpdateRequest extends FormRequest
{
    use ValidationJsonResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric',
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
            'id.required' => trans('api.id.required'),
            'firstname.required' => trans('api.firstname.required'),
            'firstname.min' => trans('api.firstname.min'),
            'lastname.required' => trans('api.lastname.required'),
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
