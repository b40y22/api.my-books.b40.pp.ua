<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Models\Author;
use App\Src\Dto\Author\AuthorRemoveDto;
use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Dto\Author\AuthorUpdateDto;
use App\Src\Repositories\Interfaces\MessageRepositoryInterface;

class MessageRepository extends AbstractRepository implements MessageRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Author::class);
    }
}
