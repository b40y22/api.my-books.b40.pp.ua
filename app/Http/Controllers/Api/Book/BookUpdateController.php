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
     * @return JsonResponse
     */
    public function __invoke(BookUpdateRequest $bookUpdateRequest): JsonResponse
    {
        $Book = $this->bookService->update($bookUpdateRequest->validatedDTO());

        if (!$Book) {
            return $this->responseError([trans('api.general.failed')], 404);
        }

        ksort($Book);

        return response()->json([
            'data' => ['book' => $Book],
            'errors' => []
        ]);
    }
}
