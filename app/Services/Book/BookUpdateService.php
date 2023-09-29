<?php
declare(strict_types=1);

namespace App\Services\Book;

use App\Dto\Book\BookUpdateDto;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Book\Interfaces\BookUpdateServiceInterface;

class BookUpdateService implements BookUpdateServiceInterface
{
    /**
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    ) {}

    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return array|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?array
    {
        $this->bookRepository->update($bookUpdateDto);

        return $this->bookRepository->get($bookUpdateDto->id);
    }
}
