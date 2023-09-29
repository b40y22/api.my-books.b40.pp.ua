<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dto\Author\AuthorStoreDto;
use App\Dto\Author\AuthorUpdateDto;
use App\Models\Author;

interface AuthorRepositoryInterface extends AbstractRepositoryInterface
{
    /**
     * @param int $id
     * @return Author|null
     */
    public function get(int $id): ?Author;

    /**
     * @param AuthorStoreDto $authorStoreDto
     * @return Author
     */
    public function store(AuthorStoreDto $authorStoreDto): Author;

    /**
     * @param AuthorUpdateDto $authorUpdateDto
     * @return bool|null
     */
    public function update(AuthorUpdateDto $authorUpdateDto): ?bool;

    /**
     * @param int $authorId
     * @return Author|null
     */
    public function remove(int $authorId): ?Author;

    /**
     * @param AuthorStoreDto $authorStoreDto
     * @return Author|null
     */
    public function createIfNotExist(AuthorStoreDto $authorStoreDto): ?Author;

    /**
     * @param array $request
     * @return array|null
     */
    public function list(array $request): ?array;
}
