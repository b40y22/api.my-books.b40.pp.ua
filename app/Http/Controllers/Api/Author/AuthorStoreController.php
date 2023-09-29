<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorStoreRequest;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthorStoreController extends Controller
{
    /**
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * @param AuthorStoreRequest $authorStoreRequest
     * @return JsonResponse
     */
    public function __invoke(AuthorStoreRequest $authorStoreRequest): JsonResponse
    {
        return $this->responseSuccess(
            ['author' => $this->authorRepository->store($authorStoreRequest->validatedDTO())],
            201
        );
    }
}
