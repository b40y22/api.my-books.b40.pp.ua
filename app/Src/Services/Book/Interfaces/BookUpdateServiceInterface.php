<?php
declare(strict_types=1);


namespace App\Src\Services\Book\Interfaces;

use App\Models\Book;
use App\Src\Dto\Book\BookUpdateDto;

interface BookUpdateServiceInterface
{
    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return array|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?array;
}
