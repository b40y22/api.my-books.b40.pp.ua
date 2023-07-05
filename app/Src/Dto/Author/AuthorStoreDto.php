<?php

namespace App\Src\Dto\Author;

class AuthorStoreDto
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
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->firstname = $request['firstname'];
        $this->lastname = $request['lastname'];
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
