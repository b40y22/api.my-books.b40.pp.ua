<?php

namespace App\Http\Requests\ExternalSource;

use App\Src\Dto\ExternalSource\ExternalSourceStoreDto;
use App\Src\Traits\ErrorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ExternalSourceStoreRequest extends FormRequest
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
            'active' => 'required|boolean',
            'class_name' => 'required|unique:external_sources|string|min:3',
            'title' => 'required|string|min:3',
            'url' => 'required|unique:external_sources|url:http,https',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => trans('api.field.required'),
            'title.min' => trans('api.general.failed'),
            'url.required' => trans('api.field.required'),
            'url.unique' => trans('api.field.unique'),
            'class_name.required' => trans('api.field.required'),
            'class_name.unique' => trans('api.field.unique'),
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
     * @return ExternalSourceStoreDto
     */
    public function validatedDTO(): ExternalSourceStoreDto
    {
        return new ExternalSourceStoreDto($this->validated());
    }
}
