<?php

namespace App\Http\Requests\Book;

use App\Src\Dto\Book\BookUpdateDto;
use App\Src\Traits\ValidationJsonResponseTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookUpdateRequest extends FormRequest
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
            'id.required' => trans('api.id.required'),
            'authors.required' => trans('api.authors.required'),
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
     * @return BookUpdateDto
     */
    public function validatedDTO(): BookUpdateDto
    {
        return new BookUpdateDto($this->validated());
    }
}
