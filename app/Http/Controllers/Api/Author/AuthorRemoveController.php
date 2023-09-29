<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
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
     * @param int $authorId
     * @return JsonResponse
     */
    public function __invoke(int $authorId): JsonResponse
    {
        $Author = $this->authorRepository->remove($authorId);

        if (!$Author) {
            return $this->responseError([trans('api.general.notFound')]);
        }

        return $this->responseSuccess(['author' => $Author]);
    }
}
