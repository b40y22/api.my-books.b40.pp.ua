<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser\Sources;

use App\Src\ValueObjects\Book\ReadBookInterface;

interface SourceInterface
{
    /**
     * @return ReadBookInterface
     */
    public function handle(): ReadBookInterface;
}
