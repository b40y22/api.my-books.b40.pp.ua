<?php
declare(strict_types=1);

namespace App\Src\Dto\Author;

use App\Src\Dto\AbstractDto;

class AuthorRemoveDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @param array $author
     */
    public function __construct(array $author)
    {
        $this->id = $author['id'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
