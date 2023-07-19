<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BookGetController extends Controller
{
    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    ) {}

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $Book = $this->bookRepository->get($id, ['with' => 'authors']);

        if (!$Book) {
            return $this->responseError([trans('api.general.notFound')], 404);
        }

        return response()->json([
            'data' => [
                'book' => $Book
            ],
            'errors' => []
        ]);
    }
}
