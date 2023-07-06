<?php
declare(strict_types=1);

namespace App\Src\Repositories\Interfaces;

use App\Models\Author;
use App\Src\Dto\Author\AuthorRemoveDto;
use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Dto\Author\AuthorUpdateDto;

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
     * @param AuthorRemoveDto $authorRemoveDto
     * @return Author|null
     */
    public function remove(AuthorRemoveDto $authorRemoveDto): ?Author;

    /**
     * @param AuthorStoreDto $authorStoreDto
     * @return Author|null
     */
    public function createIfNotExist(AuthorStoreDto $authorStoreDto): ?Author;
}
