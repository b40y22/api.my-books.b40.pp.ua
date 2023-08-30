<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser\Sources;

use App\Src\Common\Books\Builder\BuilderBookInterface;

interface SourceInterface
{
    /**
     * @return BuilderBookInterface
     */
    public function handle(): BuilderBookInterface;
}
