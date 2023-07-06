<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorStoreRequest;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthorStoreController extends Controller
{
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    public function __invoke(AuthorStoreRequest $authorStoreRequest): JsonResponse
    {
        return response()->json([
            'data' => [
                'author' => $this->authorRepository->store($authorStoreRequest->validatedDTO())
            ],
            'errors' => []
        ], 201);
    }
}
