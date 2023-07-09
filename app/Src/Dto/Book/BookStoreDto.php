<?php

namespace App\Src\Dto\Book;

use App\Src\Dto\AbstractDto;
use App\Src\Dto\Author\AuthorFromBookStoreDto;

class BookStoreDto extends AbstractDto
{
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
     * @var string|mixed|null
     */
    protected ?string $pages;

    /**
     * @var string|mixed|null
     */
    protected ?string $year;

    /**
     * @param array $book
     */
    public function __construct(array $book)
    {
        foreach ($book['authors'] as $author) {
            $this->authors[] = new AuthorFromBookStoreDto($author);
        }
        $this->description = $book['description'] ?? null;
        $this->title = $book['title'];
        $this->pages = $book['pages'] ?? null;
        $this->year = $book['year'] ?? null;
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
