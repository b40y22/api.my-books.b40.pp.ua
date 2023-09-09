<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserGetController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'data' => ['user' => $this->userRepository->get(Auth::id())],
            'errors' => []
        ]);
    }
}
