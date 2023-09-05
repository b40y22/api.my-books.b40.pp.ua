<?php
declare(strict_types=1);

namespace App\Src\Services\Monitoring;

use App\Src\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use App\Src\Traits\ExternalSourceTrait;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class MonitoringService implements MonitoringServiceInterface
{
    use ExternalSourceTrait;

    public function __construct(
        protected ExternalSourceRepositoryInterface $externalSourceRepository
    ) {}

    /**
     * @return bool
     * @throws GuzzleException
     */
    public function handle(): bool
    {
        $sources = $this->externalSourceRepository->listAll();

        $client = new Client();
        foreach ($sources as $source) {
            try {
                $response = $client->get($source->url, ['connect_timeout' => 5, 'timeout' => 5]);

                if (200 === $response->getStatusCode() && $source->status !== 1) {
                    $this->enableExternalSource($source);
                }
            } catch (Exception $e) {
                $this->disableExternalSource($source);

                Log::error('MonitoringService', [$e->getCode() => $e->getMessage()]);
            }
        }

        return true;
    }
}
