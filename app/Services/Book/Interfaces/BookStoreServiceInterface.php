<?php
declare(strict_types=1);

namespace App\Services\Book\Interfaces;

use App\Dto\Book\BookStoreDto;
use App\Models\Book;

interface BookStoreServiceInterface
{
    /**
     * @param BookStoreDto $bookStoreDto
     * @return Book
     */
    public function store(BookStoreDto $bookStoreDto): Book;
}
