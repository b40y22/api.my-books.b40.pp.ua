<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Src\Services\Auth\AuthServiceInterface;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __construct(
        protected AuthServiceInterface $loginService,
    ) {}

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $User = $this->loginService->login($request->validated());

        if ($User) {
            return response()->json([
                'data' => [
                    'token' => $User->createToken('Token')->plainTextToken
                ],
                'errors' => []
            ]);
        }

        return $this->responseError([trans('auth.login.failed')]);
    }
}
