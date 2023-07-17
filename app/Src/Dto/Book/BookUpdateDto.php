<?php
declare(strict_types=1);

namespace App\Src\Dto\Book;

use App\Src\Dto\AbstractDto;
use App\Src\Dto\Author\AuthorUpdateDto;
use App\Src\Dto\Book\Author\AuthorFromBookDto;

class BookUpdateDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var array
     */
    protected array $authors = [];

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
         foreach ($book['authors'] as $author) {
            $this->authors[] = new AuthorFromBookDto($author);
        }
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

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getPages(): ?string
    {
        return $this->pages;
    }

    /**
     * @return string|null
     */
    public function getYear(): ?string
    {
        return $this->year;
    }
}
