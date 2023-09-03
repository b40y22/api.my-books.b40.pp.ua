<?php
declare(strict_types=1);

namespace App\Src\Services\Monitoring;

interface MonitoringServiceInterface
{
    /**
     * @return bool
     */
    public function handle(): bool;
}
