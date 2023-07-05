<?php

namespace App\Src\Dto\Author;

class AuthorRemoveDto
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->id = $request['id'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
