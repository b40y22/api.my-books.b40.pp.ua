<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Src\Services\Book\BookServiceInterface;
use Illuminate\Http\JsonResponse;

class BookStoreController extends Controller
{
    public function __construct(
        protected BookServiceInterface $bookService
    ) {}

    public function __invoke(BookStoreRequest $bookStoreRequest): JsonResponse
    {
        $Book = $this->bookService->store($bookStoreRequest->validatedDTO())->toArray();

        if (!$Book) {
            return $this->responseError([trans('api.general.failed')]);
        }

        ksort($Book);

        return response()->json([
            'data' => [
                'book' => $Book
            ],
            'errors' => []
        ], 201);
    }
}
