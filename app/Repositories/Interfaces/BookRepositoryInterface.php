<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dto\Book\BookStoreDto;
use App\Dto\Book\BookUpdateDto;
use App\Models\Book;

interface BookRepositoryInterface extends AbstractRepositoryInterface
{
    /**
     * @param int $id
     * @param array $options
     * @return Book|null
     */
    public function get(int $id, array $options): ?array;

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

    /**
     * @param int $bookId
     * @return Book|null
     */
    public function remove(int $bookId): ?Book;

    /**
     * @param array $request
     * @return array|null
     */
    public function list(array $request): ?array;
}
