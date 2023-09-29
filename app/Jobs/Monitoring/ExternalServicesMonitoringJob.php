<?php
declare(strict_types=1);

namespace App\Jobs\Monitoring;

use App\Services\Monitoring\MonitoringServiceInterface;
use App\Traits\HttpTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExternalServicesMonitoringJob implements ShouldQueue
{
    public function __construct(
        protected readonly MonitoringServiceInterface $monitoringService
    ) {}

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HttpTrait;

    public function handle(): void
    {
        $this->monitoringService->handle();
    }
}
