<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Src\Dto\Author\AuthorUpdateDto;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BookUpdateController extends Controller
{
    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    ) {}

    /**
     * @param BookUpdateRequest $bookUpdateRequest
     * @return JsonResponse
     */
    public function __invoke(BookUpdateRequest $bookUpdateRequest): JsonResponse
    {
        $Book = $this->bookRepository->update($bookUpdateRequest->validatedDTO());

        if (!$Book) {
            return $this->responseError([trans('api.general.failed')]);
        }

        return response()->json([
            'data' => [
                'book' => $this->formatAuthors($bookUpdateRequest->validatedDTO()->toArray())
            ],
            'errors' => []
        ]);
    }
}
