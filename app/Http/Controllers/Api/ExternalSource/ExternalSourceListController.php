<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\ExternalSource;

use App\Http\Controllers\Controller;
use App\Src\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ExternalSourceListController extends Controller
{
    /**
     * @param ExternalSourceRepositoryInterface $externalSourceRepository
     */
    public function __construct(
        protected ExternalSourceRepositoryInterface $externalSourceRepository
    ) {}

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->responseSuccess(
            ['externalSources' => $this->externalSourceRepository->listAll()],
            201
        );
    }
}
