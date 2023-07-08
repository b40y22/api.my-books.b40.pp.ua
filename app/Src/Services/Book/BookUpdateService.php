<?php

namespace App\Src\Services\Book;

use App\Models\Book;
use App\Src\Dto\Book\BookUpdateDto;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use App\Src\Services\Book\Interfaces\BookUpdateServiceInterface;

class BookUpdateService extends AbstractBookService implements BookUpdateServiceInterface
{
    /**
     * @param BookRepositoryInterface $bookRepository
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(
        protected BookRepositoryInterface $bookRepository,
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return Book|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?Book
    {
        $this->bookRepository->update($bookUpdateDto);
        $Book = $this->bookRepository->get($bookUpdateDto->getId());

        $Book['authors'] = $this->formatAuthorsArray($bookUpdateDto->getAuthors(), $Book);

        return $Book;
    }
}
