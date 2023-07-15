<?php
declare(strict_types=1);

namespace App\Src\Common\Books\Builder;

use App\Src\Common\File;

class ReadBook
{
    /**
     * @var array
     */
    private array $authors;

    /**
     * @var int
     */
    private int $bookIdOnLoveread;

    /**
     * @var array
     */
    private array $context;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var File
     */
    private File $file;

    /**
     * @var string
     */
    private string $image;

    /**
     * @var string
     */
    private string $linkToContext;

    /**
     * @var int
     */
    private int $pages;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var int
     */
    private int $year;

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
    public function getBookIdOnLoveread(): int
    {
        return $this->bookIdOnLoveread;
    }

    /**
     * @param int $bookIdOnLoveread
     */
    public function setBookIdOnLoveread(int $bookIdOnLoveread): void
    {
        $this->bookIdOnLoveread = $bookIdOnLoveread;
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
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file): void
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
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

    /**
     * @param array $context
     * @return void
     */
    public function addToContext(array $context): void
    {
        $this->context[] = $context;
    }
}
