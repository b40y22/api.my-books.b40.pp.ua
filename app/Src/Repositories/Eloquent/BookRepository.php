<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Models\Book;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Dto\Book\BookUpdateDto;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository extends AbstractRepository implements BookRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }

    /**
     * @param BookStoreDto $bookStoreDto
     * @return Book
     */
    public function store(BookStoreDto $bookStoreDto): Book
    {
        return $this->model::create($bookStoreDto->toArray());
     }

    /**
     * @param int $id
     * @return Book|null
     */
    public function get(int $id): ?Book
    {
        return $this->model::find($id) ?? null;
    }

    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return bool|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?bool
    {
        $Book = $this->model::find($bookUpdateDto->getId());

        if (!$Book) {
            return null;
        }

        return $Book->update($bookUpdateDto->toArray());
    }
}