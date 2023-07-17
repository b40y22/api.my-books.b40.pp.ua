<?php
declare(strict_types=1);

namespace App\Src\Dto\Author;

use App\Src\Dto\AbstractDto;

class AuthorStoreDto extends AbstractDto
{
    protected string $firstname;
    protected string $lastname;

    public function __construct(array $author)
    {
        $this->firstname = $author['firstname'];
        $this->lastname = $author['lastname'];
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }
}
