<?php
declare(strict_types=1);

namespace App\Services\Import\Parser;

use App\Dto\Import\ImportBookDto;

interface ImportServiceInterface
{
    /**
     * @param ImportBookDto $importBookDto
     * @return bool
     */
    public function importBook(ImportBookDto $importBookDto): bool;
}
