<?php
declare(strict_types=1);

namespace App\Src\Services\Monitoring;

use App\Src\Repositories\Interfaces\ExternalSourceRepositoryInterface;
use DateTime;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class MonitoringService implements MonitoringServiceInterface
{
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

                if (200 === $response->getStatusCode()) {
                    if ($source->status !== 1) {
                        $source->status = 1;
                        $source->change_status_at = new DateTime();
                    }
                } else {
                    if ($source->status !== 0) {
                        $source->status = 0;
                        $source->change_status_at = new DateTime();
                    }
                }

                $source->save();
            } catch (Exception $e) {
                if ($source->status !== 0) {
                    $source->status = 0;
                    $source->change_status_at = new DateTime();

                    $source->save();
                }

                Log::error(__CLASS__, [$source->class_name => $e->getMessage()]);
            }
        }

        return true;
    }
}
