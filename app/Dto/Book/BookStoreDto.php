<?php
declare(strict_types=1);

namespace App\Dto\Book;

use App\Dto\AbstractDto;
use App\Dto\Book\Author\AuthorFromBookDto;

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
     * @var array|mixed|null
     */
    readonly public ?array $files;

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
        $this->files = $book['files'] ?? null;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }
}
