<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorUpdateRequest;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
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
     * @param int $authorId
     * @return JsonResponse
     */
    public function __invoke(AuthorUpdateRequest $authorUpdateRequest, int $authorId): JsonResponse
    {
        $authorDto = $authorUpdateRequest->validatedDTO();
        $authorDto->setId($authorId);

        $Author = $this->authorRepository->update($authorDto);

        if (!$Author) {
            return $this->responseError([trans('api.general.notFound')]);
        }

        return $this->responseSuccess(
            ['author' => $authorUpdateRequest->validatedDTO()->toArray()]
        );
    }
}
