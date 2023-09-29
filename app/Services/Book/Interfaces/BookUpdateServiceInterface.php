<?php
declare(strict_types=1);


namespace App\Services\Book\Interfaces;

use App\Dto\Book\BookUpdateDto;

interface BookUpdateServiceInterface
{
    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return array|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?array;
}
