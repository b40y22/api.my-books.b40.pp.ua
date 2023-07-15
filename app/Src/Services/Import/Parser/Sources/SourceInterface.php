<?php

namespace App\Src\Services\Import\Parser\Sources;

use App\Src\Common\Books\Builder\ReadBook;

interface SourceInterface
{
    /**
     * @return ReadBook
     */
    public function handle(): ReadBook;
}
