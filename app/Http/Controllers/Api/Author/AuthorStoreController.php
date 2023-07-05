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
        $Author = $this->authorRepository->store($authorStoreRequest->validatedDTO());

        if (!$Author) {
            return $this->responseError([trans('api.general.failed')]);
        }

        return response()->json([
            'data' => [
                'author' => $Author
            ],
            'errors' => []
        ], 201);
    }
}
