<?php
declare(strict_types=1);

namespace App\Src\Services\Book;

use App\Exceptions\ApiArgumentsException;
use App\Models\Book;
use App\Src\Dto\Book\Author\AuthorFromBookDto;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use App\Src\Services\Book\Interfaces\BookStoreServiceInterface;
use Illuminate\Support\Facades\Log;

class BookStoreService implements BookStoreServiceInterface
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
        $authors = [];

        /** @var AuthorFromBookDto $Author */
        foreach ($bookStoreDto->getAuthors() as $Author) {
            if ($Author->isNew()) {
                $authors[] = $this->authorRepository->store($Author)->toArray();
            } else {
                if ($Author->getId() < 1 && $Author->isNew() === false) {
                    Log::error('Author ID cannot be less than 1', $Author->toArray());

                    throw new ApiArgumentsException(trans('api.general.failed'), 400);
                }
                $authors[] = $this->authorRepository->get($Author->getId())->toArray();
            }
        }

        $Book->authors()->attach(array_column($authors, 'id'));
        $Book['authors'] = $authors;

        return $Book;
    }
}
