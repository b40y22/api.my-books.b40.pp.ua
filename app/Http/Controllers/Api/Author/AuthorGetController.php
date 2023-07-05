<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthorGetController extends Controller
{
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $Author = $this->authorRepository->get($id);

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