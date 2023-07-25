<?php
declare(strict_types=1);

namespace App\Src\Dto\Book;

use App\Src\Dto\AbstractDto;
use App\Src\Dto\Book\Author\AuthorFromBookDto;

class BookStoreDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $user_id;

    /**
     * @var array
     */
    protected array $authors = [];

    /**
     * @var string|mixed|null
     */
    protected ?string $description;

    /**
     * @var string|mixed
     */
    protected string $title;

    /**
     * @var int|null
     */
    protected ?int $pages;

    /**
     * @var int|null
     */
    protected ?int $year;

    /**
     * @param array $book
     */
    public function __construct(array $book)
    {
        $this->user_id = $book['user_id'];
        foreach ($book['authors'] as $author) {
            $this->authors[] = new AuthorFromBookDto(array_merge($author, ['user_id' => $book['user_id']]));
        }
        $this->description = $book['description'] ?? null;
        $this->title = $book['title'];
        $this->pages = isset($book['pages']) ? (int) $book['pages'] : null;
        $this->year = isset($book['year']) ? (int) $book['year'] : null;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }
}
