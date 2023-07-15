<?php

namespace App\Src\Services\Import\Parser;

use App\Src\Dto\Import\ImportBookDto;

interface ImportServiceInterface
{
    /**
     * @param ImportBookDto $importBookDto
     * @return mixed
     */
    public function importBook(ImportBookDto $importBookDto): mixed;
}
