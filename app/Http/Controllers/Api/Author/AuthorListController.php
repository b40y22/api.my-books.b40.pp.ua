<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Src\Services\Author\Interfaces\AuthorListServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorListController extends Controller
{
    /**
     * @param AuthorListServiceInterface $authorListService
     */
    public function __construct(
        protected AuthorListServiceInterface $authorListService
    ) {}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'data' => [
                'authors' => $this->authorListService->list($request->all())
            ],
            'errors' => []
        ]);
    }
}
