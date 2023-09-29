<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Services\Book\Interfaces\BookStoreServiceInterface;
use Illuminate\Http\JsonResponse;

class BookStoreController extends Controller
{
    /**
     * @param BookStoreServiceInterface $bookService
     */
    public function __construct(
        protected BookStoreServiceInterface $bookService
    ) {}

    /**
     * @param BookStoreRequest $bookStoreRequest
     * @return JsonResponse
     */
    public function __invoke(BookStoreRequest $bookStoreRequest): JsonResponse
    {
        $Book = $this->bookService->store($bookStoreRequest->validatedDTO())->toArray();

        if (!$Book) {
            return $this->responseError([trans('api.general.failed')]);
        }

        ksort($Book);

        return $this->responseSuccess(['book' => $Book], 201);
    }
}
