<?php
declare(strict_types=1);

namespace App\Services\Import\Parser\Sources;

use App\ValueObjects\Book\ReadBookInterface;

interface SourceInterface
{
    /**
     * @return ReadBookInterface
     */
    public function handle(): ReadBookInterface;
}
