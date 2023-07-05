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
     * @param AuthorStoreDto $registerDto
     * @return Author|null
     */
    public function store(AuthorStoreDto $registerDto): ?Author;

    /**
     * @param AuthorUpdateDto $registerDto
     * @return bool|null
     */
    public function update(AuthorUpdateDto $registerDto): ?bool;

    /**
     * @param AuthorRemoveDto $authorRemoveDto
     * @return Author|null
     */
    public function remove(AuthorRemoveDto $authorRemoveDto): ?Author;
}
