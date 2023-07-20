<?php

namespace App\Src\Services\Import\Parser;

use App\Src\Dto\Import\ImportBookDto;

interface ImportServiceInterface
{
    /**
     * @param ImportBookDto $importBookDto
     * @return bool
     */
    public function importBook(ImportBookDto $importBookDto): bool;
}
