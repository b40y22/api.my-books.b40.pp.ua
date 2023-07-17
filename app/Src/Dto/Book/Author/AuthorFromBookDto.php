<?php
declare(strict_types=1);

namespace App\Src\Dto\Book\Author;

use App\Src\Dto\Author\AuthorStoreDto;

class AuthorFromBookDto extends AuthorStoreDto
{
    protected int $id;
    protected bool $new;

    public function __construct(array $author)
    {
        parent::__construct($author);
        $this->id = $author['id'];
        $this->new = $author['new'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isNew(): bool
    {
        return $this->new;
    }

    public function getFullNameArray(): array
    {
        return [
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
        ];
    }
}
