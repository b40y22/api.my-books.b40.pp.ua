<?php
declare(strict_types=1);

namespace App\Http\Requests\Book;

use App\Src\Dto\Book\BookRemoveDto;
use App\Src\Traits\ValidationJsonResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookRemoveRequest extends FormRequest
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
     * @return string[]
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
            'id.required' => trans('api.id.required'),
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
     * @return BookRemoveDto
     */
    public function validatedDTO(): BookRemoveDto
    {
        return new BookRemoveDto($this->validated());
    }
}
