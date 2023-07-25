<?php
declare(strict_types=1);

namespace App\Src\Dto\Book;

use App\Src\Dto\AbstractDto;

class BookUpdateDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var int
     */
    protected int $user_id;

    /**
     * @var string|mixed|null
     */
    protected ?string $description;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var int|mixed|null
     */
    protected ?int $pages;

    /**
     * @var int|mixed|null
     */
    protected ?int $year;

    /**
     * @param array $book
     */
    public function __construct(array $book)
    {
        $this->id = $book['id'];
        $this->description = $book['description'] ?? null;
        $this->title = $book['title'];
        $this->pages = $book['pages'] ?? null;
        $this->year = $book['year'] ?? null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
