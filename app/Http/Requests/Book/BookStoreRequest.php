<?php

namespace App\Http\Requests\Book;

use App\Src\Dto\Book\BookStoreDto;
use App\Src\Traits\ValidationJsonResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookStoreRequest extends FormRequest
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
            'authors' => 'required|array',
            'description' => 'nullable|string',
            'title' => 'required|string|min:2',
            'pages' => 'nullable|integer',
            'year' => 'nullable|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'authors.required' => trans('api.field.required'),
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
     * @return BookStoreDto
     */
    public function validatedDTO(): BookStoreDto
    {
        return new BookStoreDto($this->validated());
    }
}
