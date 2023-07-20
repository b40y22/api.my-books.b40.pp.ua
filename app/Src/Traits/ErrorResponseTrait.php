<?php
declare(strict_types=1);

namespace App\Src\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait ErrorResponseTrait
{
    /**
     * @param Validator $validator
     * @return ValidationException
     * @throws ValidationException
     */
    public function makeJsonResponse(Validator $validator): ValidationException
    {
        $result = [];
        foreach ($validator->errors()->getMessages() as $field) {
            foreach ($field as $error) {
                $result[] = $error;
            }
        }

        throw new ValidationException(
            $validator,
            response()->json(['data' => [], 'errors' => $result], 422)
        );
    }
}
