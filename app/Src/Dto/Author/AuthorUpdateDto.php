<?php

namespace App\Src\Dto\Author;

use App\Src\Dto\AbstractDto;

class AuthorUpdateDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $id;

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
        $this->id = $author['id'];
        $this->firstname = $author['firstname'];
        $this->lastname = $author['lastname'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
