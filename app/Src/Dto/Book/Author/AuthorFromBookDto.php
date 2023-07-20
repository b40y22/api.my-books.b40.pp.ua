<?php
declare(strict_types=1);

namespace App\Src\Dto\Book\Author;

use App\Src\Dto\Author\AuthorStoreDto;

class AuthorFromBookDto extends AuthorStoreDto
{
    /**
     * @var int|mixed
     */
    protected int $id;

    /**
     * @var bool|mixed
     */
    protected bool $new;

    /**
     * @param array $author
     */
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
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * @return array
     */
    public function getFullNameArray(): array
    {
        return [
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
        ];
    }
}
