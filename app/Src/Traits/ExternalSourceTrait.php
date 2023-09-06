<?php
declare(strict_types=1);

namespace App\Src\Traits;

use App\Models\ExternalSource;
use App\Src\Repositories\Eloquent\ExternalSourceRepository;
use DateTime;

trait ExternalSourceTrait
{
    use HttpTrait;

    /**
     * @param string $url
     * @return void
     */
    protected function disableExternalSourceByUrl(string $url): void
    {
        $className = $this->getParserClassNameFromDomain($url);
        $externalSource = (new ExternalSourceRepository())->getExternalSourceByClassName($className);
        if ($externalSource && $externalSource->status !== 0) {
            $this->disableExternalSource($externalSource);
        }
    }

    /**
     * @param ExternalSource $externalSource
     * @return void
     */
    protected function disableExternalSource(ExternalSource $externalSource): void
    {
        $externalSource->status = 0;
        $externalSource->change_status_at = new DateTime();
        $externalSource->save();
    }

    /**
     * @param ExternalSource $externalSource
     * @return void
     */
    protected function enableExternalSource(ExternalSource $externalSource): void
    {
        $externalSource->status = 1;
        $externalSource->change_status_at = new DateTime();
        $externalSource->save();
    }
}
