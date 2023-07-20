<?php
declare(strict_types=1);

namespace App\Src\Services\Book;

use App\Exceptions\ApiArgumentsException;
use App\Models\Book;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use App\Src\Services\Book\Interfaces\BookStoreServiceInterface;

class BookStoreService extends AbstractBookService implements BookStoreServiceInterface
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
     * @param BookStoreDto $bookStoreDto
     * @return Book
     * @throws ApiArgumentsException
     */
    public function store(BookStoreDto $bookStoreDto): Book
    {
        $Book = $this->bookRepository->store($bookStoreDto);

        $authors = $this->formatAuthorsArray($bookStoreDto->getAuthors());

        $Book->authors()->attach(array_column($authors, 'id'));

        $Book['authors'] = $authors;

        return $Book;
    }
}
