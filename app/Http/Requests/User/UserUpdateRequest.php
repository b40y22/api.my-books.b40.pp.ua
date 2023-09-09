<?php
declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Src\Dto\User\UserUpdateDto;
use App\Src\Traits\ErrorResponseTrait;
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
        $rules = [
            'id' => 'required|numeric',
        ];

        if (isset($this->name)) {
            $rules['name'] = 'string|min:3';
        }

        if (isset($this->email)) {
            $rules['email'] = 'email|min:3';
        }

        if (isset($this->image)) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif';
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => trans('api.field.required'),
            'name.min' => trans('api.field.min'),
            'email.email' => trans('api.field.email'),
            'email.min' => trans('api.field.min'),
            'image.image' => trans('api.field.image'),
            'image.mimes' => trans('api.field.image.mimes'),
            'image.max' => trans('api.field.image.max')
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
        return new UserUpdateDto($this->validated());
    }

    /**
     * @param $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        // Додайте кастомне правило для перевірки ідентифікатора користувача
        $validator->after(function ($validator) {
            if ($this->input('id') != auth()->id()) {
                $validator->errors()->add('id', trans('api.access.denied'));
            }
        });
    }
}
