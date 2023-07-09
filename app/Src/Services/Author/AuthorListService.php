<?php
declare(strict_types=1);

namespace App\Src\Services\Author;

use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Src\Services\Author\Interfaces\AuthorListServiceInterface;

class AuthorListService implements AuthorListServiceInterface
{
    /**
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * @param array $request
     * @return array
     */
    public function list(array $request): array
    {
        return $this->authorRepository->list($request);
    }
}
