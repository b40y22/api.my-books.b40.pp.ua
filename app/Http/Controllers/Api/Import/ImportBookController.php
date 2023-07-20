<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Import;

use App\Http\Controllers\Controller;
use App\Http\Requests\Import\ImportBookRequest;
use App\Jobs\Import\ImportBookJob;
use App\Src\Services\Import\Parser\ImportServiceInterface;
use App\Src\Traits\HttpTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ImportBookController extends Controller
{
    use HttpTrait;
    /**
     * @param ImportServiceInterface $importService
     */
    public function __construct(
        protected ImportServiceInterface $importService
    ) {}

    /**
     * @param ImportBookRequest $importBookRequest
     * @return JsonResponse
     */
    public function __invoke(ImportBookRequest $importBookRequest): JsonResponse
    {
        $ImportBookDto = $importBookRequest->validatedDTO();
        $ImportBookDto->setUserId(Auth::id());

        dispatch((
            new ImportBookJob(
                $this->importService,
                $ImportBookDto
            )
        )->onQueue('import'));

        return response()->json([
            'data' => [trans('api.general.successfully')],
            'errors' => []
        ]);
    }
}
