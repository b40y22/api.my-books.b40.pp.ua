<?php

namespace App\Src\Dto\Book;

use App\Src\Dto\AbstractDto;
use App\Src\Dto\Author\AuthorFromBookStoreDto;

class BookUpdateDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var array
     */
    protected array $authors;
    /**
     * @var string
     */
    protected string $description;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string
     */
    protected string $pages;

    /**
     * @var string
     */
    protected string $year;

    /**
     * @param array $book
     */
    public function __construct(array $book)
    {
        $this->id = $book['id'];
         foreach ($book['authors'] as $author) {
            $this->authors[] = new AuthorFromBookStoreDto($author);
        }
        $this->description = $book['description'];
        $this->title = $book['title'];
        $this->pages = $book['pages'];
        $this->year = $book['year'];
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
     * @return string
     */
    public function getDescription(): string
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
     * @return string
     */
    public function getPages(): string
    {
        return $this->pages;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }
}
