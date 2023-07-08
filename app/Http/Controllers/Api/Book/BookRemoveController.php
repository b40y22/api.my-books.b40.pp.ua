<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRemoveRequest;
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
     * @param BookRemoveRequest $bookRemoveRequest
     * @return JsonResponse
     */
    public function __invoke(BookRemoveRequest $bookRemoveRequest): JsonResponse
    {
        $Book = $this->bookRepository->remove($bookRemoveRequest->validatedDTO());

        if (!$Book) {
            return $this->responseError([trans('api.general.failed')]);
        }

        return response()->json([
            'data' => [
                'book' => $Book
            ],
            'errors' => []
        ]);
    }
}
