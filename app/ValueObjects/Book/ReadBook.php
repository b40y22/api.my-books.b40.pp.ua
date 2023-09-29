<?php
declare(strict_types=1);

namespace App\ValueObjects\Book;

use App\ValueObjects\File\File;
use Exception;

class ReadBook implements ReadBookInterface
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
     * @var array
     */
    private array $files;

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

    public function getFiles(): array
    {
        return $this->files;
    }

    public function setFiles(array $files): void
    {
        $this->files = $files;
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

    public function addToFiles(array $newFile): void
    {
        $this->files = array_merge($this->files, $newFile);
    }

    /**
     * @throws Exception
     */
    public function getFilesAsArray(): array
    {
        $result = [];

        foreach ($this->files as $extension => $file) {
            /** @var File $file */
            $result[$extension] = $file->getFullFilename();
        }

        return $result;
    }
}
