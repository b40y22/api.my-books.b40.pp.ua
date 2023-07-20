<?php
declare(strict_types=1);

namespace App\Src\Services\Book\Interfaces;

use App\Models\Book;
use App\Src\Dto\Book\BookStoreDto;

interface BookStoreServiceInterface
{
    /**
     * @param BookStoreDto $bookStoreDto
     * @return Book
     */
    public function store(BookStoreDto $bookStoreDto): Book;
}
