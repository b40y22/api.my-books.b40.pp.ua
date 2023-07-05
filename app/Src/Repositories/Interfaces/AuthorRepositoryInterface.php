<?php
declare(strict_types=1);

namespace App\Src\Repositories\Interfaces;

use App\Models\Author;
use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Dto\Author\AuthorUpdateDto;

interface AuthorRepositoryInterface extends AbstractRepositoryInterface
{
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
}
