<?php
declare(strict_types=1);

namespace App\Src\Common\Books\Builder;

use App\Src\Common\File;

class ReadBook implements BuilderBookInterface
{
    /**
     * @var array
     */
    private array $authors = [];

    /**
     * @var int
     */
    private int $bookId = 0;

    /**
     * @var array
     */
    private array $context = [];

    /**
     * @var string
     */
    private string $description = '';

    /**
     * @var File
     */
    private File $file;

    /**
     * @var string
     */
    private string $image = '';

    /**
     * @var string
     */
    private string $linkToContext = '';

    /**
     * @var int
     */
    private int $pages = 0;

    /**
     * @var string
     */
    private string $title = '';

    /**
     * @var int
     */
    private int $year = 0;

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param array $authors
     */
    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     */
    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @param array $context
     */
    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getLinkToContext(): string
    {
        return $this->linkToContext;
    }

    /**
     * @param string $linkToContext
     */
    public function setLinkToContext(string $linkToContext): void
    {
        $this->linkToContext = $linkToContext;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @param int $pages
     */
    public function setPages(int $pages): void
    {
        $this->pages = $pages;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }
}
