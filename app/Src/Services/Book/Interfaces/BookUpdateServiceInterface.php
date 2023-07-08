<?php

namespace App\Src\Services\Book\Interfaces;

use App\Models\Book;
use App\Src\Dto\Book\BookUpdateDto;

interface BookUpdateServiceInterface
{
    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return Book|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?Book;
}
