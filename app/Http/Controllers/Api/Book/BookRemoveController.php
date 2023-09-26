<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BookRemoveController extends Controller
{
    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    ) {}

    /**
     * @param int $bookId
     * @return JsonResponse
     */
    public function __invoke(int $bookId): JsonResponse
    {
        $Book = $this->bookRepository->remove($bookId);

        if (!$Book) {
            return $this->responseError([trans('api.general.failed')]);
        }

        return $this->responseSuccess(['book' => $Book]);
    }
}
