<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        $User = $this->loginService->login($request->validatedDTO());

        if (!$User) {
            return $this->responseError([trans('auth.login.failed')]);
        }

        return response()->json([
            'data' => [
                'token' => $User->createToken('Token')->plainTextToken
            ],
            'errors' => []
        ]);
    }
}
