<?php

namespace App\Http\Requests\Import;

use App\Dto\Import\ImportBookDto;
use App\Traits\ErrorResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ImportBookRequest extends FormRequest
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
            'link' => 'required|string|url',
            'type' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'link.required' => trans('api.field.required'),
            'link.url' => trans('api.import.url'),
            'type.required' => trans('api.import.url'),
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
     * @return ImportBookDto
     */
    public function validatedDTO(): ImportBookDto
    {
        return new ImportBookDto($this->validated());
    }
}
