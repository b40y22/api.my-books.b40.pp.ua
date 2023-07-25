<?php
declare(strict_types=1);

namespace App\Src\Repositories\Interfaces;

use App\Models\Author;
use App\Src\Dto\Author\AuthorRemoveDto;
use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Dto\Author\AuthorUpdateDto;

interface MessageRepositoryInterface extends AbstractRepositoryInterface
{
    public function store(array $message);
}
