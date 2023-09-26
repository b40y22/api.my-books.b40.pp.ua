<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Src\Services\Book\Interfaces\BookUpdateServiceInterface;
use Illuminate\Http\JsonResponse;

class BookUpdateController extends Controller
{
    /**
     * @param BookUpdateServiceInterface $bookService
     */
    public function __construct(
        protected BookUpdateServiceInterface $bookService
    ) {}

    /**
     * @param BookUpdateRequest $bookUpdateRequest
     * @param int $bookId
     * @return JsonResponse
     */
    public function __invoke(BookUpdateRequest $bookUpdateRequest, int $bookId): JsonResponse
    {
        $bookUpdateDto = $bookUpdateRequest->validatedDTO();
        $bookUpdateDto->setId($bookId);

        $Book = $this->bookService->update($bookUpdateDto);

        if (!$Book) {
            return $this->responseError([trans('api.general.failed')], 404);
        }

        ksort($Book);

        return $this->responseSuccess(['book' => $Book]);
    }
}
