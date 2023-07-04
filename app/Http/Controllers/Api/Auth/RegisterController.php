<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
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
        $user = $this->userRepository->store($request->validated());

        if ($user) {
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['token' => $token], 201);
        }

        return response()->json();
    }
}
