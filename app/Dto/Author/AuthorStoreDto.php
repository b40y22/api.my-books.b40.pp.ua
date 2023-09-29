<?php
declare(strict_types=1);

namespace App\Dto\Author;

use App\Dto\AbstractDto;

class AuthorStoreDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $user_id;

    /**
     * @var string|mixed
     */
    protected string $firstname;

    /**
     * @var string|mixed
     */
    protected string $lastname;

    /**
     * @param array $author
     */
    public function __construct(array $author)
    {
        $this->user_id = $author['user_id'];
        $this->firstname = $author['firstname'];
        $this->lastname = $author['lastname'];
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
