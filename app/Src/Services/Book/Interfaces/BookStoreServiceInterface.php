<?php

namespace App\Src\Services\Book\Interfaces;

use App\Models\Book;
use App\Src\Dto\Book\BookStoreDto;

interface BookStoreServiceInterface
{
    /**
     * @param BookStoreDto $bookStoreDto
     * @return Book|null
     */
    public function store(BookStoreDto $bookStoreDto): ?Book;
}
