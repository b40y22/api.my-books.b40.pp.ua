<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\User\Interfaces\UserPhotoUpdateServiceInterface;
use Illuminate\Http\Request;

class UserPhotoUpdateController extends Controller
{
    public function __construct(
        protected UserPhotoUpdateServiceInterface $userUpdateService
    ) {}

    public function __invoke(Request $userUpdateRequest): \Illuminate\Http\JsonResponse
    {
        return $this->responseSuccess(
            ['photo' => $this->userUpdateService->upload($userUpdateRequest)]
        );
    }
}
