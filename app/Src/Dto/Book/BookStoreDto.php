<?php
declare(strict_types=1);

namespace App\Src\Dto\Book;

use App\Src\Dto\AbstractDto;
use App\Src\Dto\Book\Author\AuthorFromBookDto;

class BookStoreDto extends AbstractDto
{
    protected array $authors = [];
    protected ?string $description;
    protected string $title;
    protected ?int $pages;
    protected ?int $year;

    public function __construct(array $book)
    {
        foreach ($book['authors'] as $author) {
            $this->authors[] = new AuthorFromBookDto($author);
        }
        $this->description = $book['description'] ?? null;
        $this->title = $book['title'];
        $this->pages = $book['pages'] ?? null;
        $this->year = $book['year'] ?? null;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPages(): ?string
    {
        return $this->pages;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }
}
