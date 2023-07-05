<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $User = $this->userRepository->store($request->validatedDTO());

        if (!$User) {
            return $this->responseError([trans('auth.register.failed')]);
        }

        return response()->json([
            'data' => [
                'token' => $User->createToken('authToken')->plainTextToken
            ],
            'errors' => []
        ], 201);
    }
}