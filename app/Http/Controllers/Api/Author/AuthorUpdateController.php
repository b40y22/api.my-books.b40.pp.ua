<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorUpdateRequest;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthorUpdateController extends Controller
{
    /**
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * @param AuthorUpdateRequest $authorUpdateRequest
     * @return JsonResponse
     */
    public function __invoke(AuthorUpdateRequest $authorUpdateRequest): JsonResponse
    {
        $Author = $this->authorRepository->update($authorUpdateRequest->validatedDTO());

        if (!$Author) {
            return $this->responseError([trans('api.general.failed')]);
        }

        return response()->json([
            'data' => [
                'author' => $authorUpdateRequest->validatedDTO()->toArray()
            ],
            'errors' => []
        ]);
    }
}
