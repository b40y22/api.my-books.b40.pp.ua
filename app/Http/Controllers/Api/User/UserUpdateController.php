<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Src\Services\User\Interfaces\UserUpdateServiceInterface;
use Illuminate\Http\JsonResponse;

class UserUpdateController extends Controller
{
    /**
     * @param UserUpdateServiceInterface $userUpdateService
     */
    public function __construct(
        protected UserUpdateServiceInterface $userUpdateService
    ) {}

    /**
     * @param UserUpdateRequest $userUpdateRequest
     * @return JsonResponse
     */
    public function __invoke(UserUpdateRequest $userUpdateRequest): JsonResponse
    {
        return $this->responseSuccess(
            ['user' => $this->userUpdateService->update($userUpdateRequest->validatedDTO())]
        );
    }
}
