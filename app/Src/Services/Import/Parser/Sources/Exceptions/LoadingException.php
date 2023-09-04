<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser\Sources\Exceptions;

use App\Src\Repositories\Eloquent\ExternalSourceRepository;
use App\Src\Traits\HttpTrait;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;

class LoadingException extends Exception
{
    use HttpTrait;

    /**
     * @param string $url
     * @param Exception $e
     */
    public function __construct(string $url, Exception $e)
    {
        parent::__construct();

        $className = $this->getParserClassNameFromDomain($url);
        $externalSource = (new ExternalSourceRepository())->getExternalSourceByClassName($className);

        if ($externalSource && $externalSource->status !== 0) {
            $externalSource->status = 0;
            $externalSource->change_status_at = new DateTime();
            $externalSource->save();
        }

        Log::error(__CLASS__, [$e->getCode() => $e->getMessage()]);
    }
}
