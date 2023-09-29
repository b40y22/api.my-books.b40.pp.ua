<?php
declare(strict_types=1);

namespace App\Dto\Author;

use App\Dto\AbstractDto;

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

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
