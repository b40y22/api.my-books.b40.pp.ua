<?php

namespace App\Src\Dto\Author;

class AuthorFromBookStoreDto extends AuthorStoreDto
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var bool
     */
    protected bool $new;

    public function __construct(array $author)
    {
        parent::__construct($author);
        $this->id = $author['id'];
        $this->new = $author['new'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getNew(): bool
    {
        return $this->new;
    }
}
