<?php

namespace App\Src\Services\Import\ContextLocation;

use App\Src\Common\Books\Builder\ReadBook;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Repositories\Eloquent\AuthorRepository;
use App\Src\Repositories\Eloquent\BookRepository;
use App\Src\Services\Book\BookStoreService;
use App\Src\Traits\FileNameGenerate;

class Db implements ContextLocationInterface
{
    use FileNameGenerate;

    /**
     * @param ReadBook $ReadBook
     */
    public function __construct(
        protected ReadBook $ReadBook
     ) {}

    public function handle(): bool
    {
        $this->storeBookInformation();

        return true;
    }

    private function storeBookInformation(): void
    {
        $BookStoreDto = new BookStoreDto([
            'authors' => $this->ReadBook->getAuthors(),
            'description' => $this->ReadBook->getDescription(),
            'title' => $this->ReadBook->getTitle(),
            'pages' => $this->ReadBook->getPages(),
            'year' => $this->ReadBook->getYear(),
        ]);

        $BookStoreService = (new BookStoreService(
            new BookRepository(),
            new AuthorRepository()
        ))->store($BookStoreDto);

        dump($BookStoreService);

        dd($this->ReadBook->getTitle());
    }
}
