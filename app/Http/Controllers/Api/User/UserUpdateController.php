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

    public function __invoke(UserUpdateRequest $userUpdateRequest, int $userId): JsonResponse
    {
        $userUpdateDto = $userUpdateRequest->validatedDTO();
        $userUpdateDto->setId($userId);

        return $this->responseSuccess(
            ['user' => $this->userUpdateService->update($userUpdateDto)]
        );
    }
}
