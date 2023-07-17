<?php
declare(strict_types=1);

namespace App\Src\Dto\Book;

use App\Src\Dto\AbstractDto;

class BookRemoveDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @param array $book
     */
    public function __construct(array $book)
    {
        $this->id = $book['id'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
