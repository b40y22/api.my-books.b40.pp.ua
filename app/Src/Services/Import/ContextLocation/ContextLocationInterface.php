<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

interface ContextLocationInterface
{
    /**
     * @return bool
     */
    public function handle(): bool;
}
