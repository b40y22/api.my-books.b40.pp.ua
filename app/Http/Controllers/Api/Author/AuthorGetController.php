<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorGetController extends Controller
{
    /**
     * @param Author $Author
     * @return JsonResponse
     */
    public function __invoke(Author $Author): JsonResponse
    {
        return response()->json([
            'data' => [
                'author' => $Author
            ],
            'errors' => []
        ]);
    }
}
