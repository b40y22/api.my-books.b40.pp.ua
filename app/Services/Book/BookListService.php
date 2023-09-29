<?php
declare(strict_types=1);

namespace App\Services\Book;

use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Book\Interfaces\BookListServiceInterface;

class BookListService implements BookListServiceInterface
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
     * @param array $request
     * @return array
     */
    public function list(array $request): array
    {
        return $this->bookRepository->list($request);
    }
}
