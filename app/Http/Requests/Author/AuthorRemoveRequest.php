<?php
declare(strict_types=1);

namespace App\Http\Requests\Author;

use App\Src\Dto\Author\AuthorRemoveDto;
use App\Src\Traits\ValidationJsonResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthorRemoveRequest extends FormRequest
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
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => __('api.id.required'),
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
     * @return AuthorRemoveDto
     */
    public function validatedDTO(): AuthorRemoveDto
    {
        return new AuthorRemoveDto($this->validated());
    }
}
