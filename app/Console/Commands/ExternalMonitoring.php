<?php

namespace App\Console\Commands;

use App\Jobs\Monitoring\ExternalServicesMonitoringJob;
use App\Repositories\Eloquent\ExternalSourceRepository;
use App\Services\Monitoring\MonitoringService;
use App\Services\Monitoring\MonitoringServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExternalMonitoring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'external-monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command run monitoring service for external source sites with books (like http://loveread.ec)';

    /**
     * @param MonitoringServiceInterface $monitoringService
     */
    public function __construct(
        protected MonitoringServiceInterface $monitoringService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $repo = new ExternalSourceRepository();
        $service = new MonitoringService($repo);

        dispatch(
            (new ExternalServicesMonitoringJob($service))->onQueue('monitoring')
        );
        Log::info('The message for the queue was created successfully');
    }
}
