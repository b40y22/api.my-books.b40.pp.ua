<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorRemoveRequest;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthorRemoveController extends Controller
{
    /**
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * @param AuthorRemoveRequest $authorRemoveRequest
     * @return JsonResponse
     */
    public function __invoke(AuthorRemoveRequest $authorRemoveRequest): JsonResponse
    {
        $Author = $this->authorRepository->remove($authorRemoveRequest->validatedDTO());

        if (!$Author) {
            return $this->responseError([trans('api.general.failed')]);
        }

        return response()->json([
            'data' => [
                'author' => $Author
            ],
            'errors' => []
        ]);
    }
}
