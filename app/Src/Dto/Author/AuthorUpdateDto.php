<?php

namespace App\Src\Dto\Author;

class AuthorUpdateDto
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
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->id = $request['id'];
        $this->firstname = $request['firstname'];
        $this->lastname = $request['lastname'];
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
