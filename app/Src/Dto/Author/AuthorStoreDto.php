<?php

namespace App\Src\Dto\Author;

use App\Src\Dto\AbstractDto;

class AuthorStoreDto extends AbstractDto
{
    /**
     * @var string
     */
    protected string $firstname;

    /**
     * @var string
     */
    protected string $lastname;

    /**
     * @param array $author
     */
    public function __construct(array $author)
    {
        $this->firstname = $author['firstname'] ?? '';
        $this->lastname = $author['lastname'] ?? '';
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }
}
