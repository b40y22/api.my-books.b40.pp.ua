<?php

namespace App\Src\Services\Import\ContextLocation;

interface ContextLocationInterface
{
    /**
     * @return bool
     */
    public function handle(): bool;
}
