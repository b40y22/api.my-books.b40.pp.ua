<?php

namespace App\Http\Controllers;

use App\Src\Dto\Author\AuthorUpdateDto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function responseError(array $errors = [], int $status = 500): JsonResponse
    {
        return response()->json([
            'data' => [],
            'errors' => $errors,
        ], $status);
    }

    /**
     * @param array $book
     * @return array
     */
    protected function formatAuthors(array $book): array
    {
        $authors = $book['authors'];
        unset($book['authors']);

        /** @var AuthorUpdateDto $author */
        foreach ($authors as $author) {
            $book['authors'][] = $author->toArray();
        }

        ksort($book);

        return $book;
    }
}
