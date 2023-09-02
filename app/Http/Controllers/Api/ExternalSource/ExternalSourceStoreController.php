<?php

namespace App\Http\Controllers\Api\ExternalSource;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExternalSource\ExternalSourceStoreRequest;
use App\Src\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ExternalSourceStoreController extends Controller
{
    /**
     * @param ExternalSourceRepositoryInterface $externalSourceRepository
     */
    public function __construct(
        protected ExternalSourceRepositoryInterface $externalSourceRepository
    ) {}

    /**
     * @param ExternalSourceStoreRequest $externalSourceStoreRequest
     * @return JsonResponse
     */
    public function __invoke(ExternalSourceStoreRequest $externalSourceStoreRequest): JsonResponse
    {
        return response()->json([
            'data' => [
                'externalSource' => $this->externalSourceRepository->store($externalSourceStoreRequest->validatedDTO())
            ],
            'errors' => []
        ], 201);
    }
}
