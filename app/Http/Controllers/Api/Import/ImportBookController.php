<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\Import\ImportBookRequest;
use App\Jobs\Import\ImportBookJob;
use App\Src\Dto\Import\ImportBookDto;
use App\Src\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use App\Src\Services\Import\Parser\ImportServiceInterface;
use App\Src\Traits\HttpTrait;
use Illuminate\Http\JsonResponse;

class ImportBookController extends Controller
{
    use HttpTrait;

    /**
     * @param ImportServiceInterface $importService
     * @param ExternalSourceRepositoryInterface $externalSourceRepository
     */
    public function __construct(
        protected ImportServiceInterface $importService,
        protected ExternalSourceRepositoryInterface $externalSourceRepository
    ) {}

    /**
     * @param ImportBookRequest $importBookRequest
     * @return JsonResponse
     */
    public function __invoke(ImportBookRequest $importBookRequest): JsonResponse
    {
        $className = $this->getParserClassNameFromDomain($importBookRequest->get('link'));
        $externalSource = $this->externalSourceRepository->getExternalSourceByClassName($className);

        if ($externalSource->status) {
            $ImportBookDto = new ImportBookDto($importBookRequest->validatedDTO()->toArray());

            dispatch((new ImportBookJob($this->importService, $ImportBookDto))->onQueue('import'));

            return $this->responseSuccess(
                ['data' => trans('api.general.successfully')]
            );
        }

        return $this->responseError(
            ['data' => trans('api.external.disabled')]
        );
    }
}
