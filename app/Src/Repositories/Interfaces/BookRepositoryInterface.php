<?php
declare(strict_types=1);

namespace App\Src\Repositories\Interfaces;

use App\Models\Book;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Dto\Book\BookUpdateDto;

interface BookRepositoryInterface extends AbstractRepositoryInterface
{
    /**
     * @param int $id
     * @return Book|null
     */
    public function get(int $id): ?Book;

    /**
     * @param BookStoreDto $bookStoreDto
     * @return Book
     */
    public function store(BookStoreDto $bookStoreDto): Book;

    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return bool|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?bool;
}
