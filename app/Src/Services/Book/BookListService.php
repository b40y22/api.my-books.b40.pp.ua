<?php
declare(strict_types=1);

namespace App\Src\Services\Book;

use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use App\Src\Services\Book\Interfaces\BookListServiceInterface;

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
