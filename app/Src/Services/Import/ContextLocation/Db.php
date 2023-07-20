<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

use App\Events\CreateMessageAfterStoreBookContextEvent;
use App\Exceptions\ApiArgumentsException;
use App\Exceptions\ExternalServiceException;
use App\Src\Common\Books\Builder\ReadBook;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Repositories\Eloquent\AuthorRepository;
use App\Src\Repositories\Eloquent\BookContextRepository;
use App\Src\Repositories\Eloquent\BookRepository;
use App\Src\Repositories\Interfaces\BookContextRepositoryInterface;
use App\Src\Services\Book\BookStoreService;
use App\Src\Traits\FileNameGenerate;

class Db implements ContextLocationInterface
{
    use FileNameGenerate;

    protected BookContextRepositoryInterface $bookContextRepository;

    /**
     * @param ReadBook $ReadBook
     * @param int $userId
     */
    public function __construct(
        protected ReadBook $ReadBook,
        protected int $userId
    ) {
        $this->bookContextRepository = new BookContextRepository();
    }

    /**
     * @return bool
     * @throws ApiArgumentsException
     * @throws ExternalServiceException
     */
    public function handle(): bool
    {
        $this->storeBookInformation();

        return true;
    }

    /**
     * @throws ApiArgumentsException
     * @throws ExternalServiceException
     */
    private function storeBookInformation(): void
    {
        $BookStoreDto = new BookStoreDto([
            'user_id' => $this->userId,
            'authors' => $this->ReadBook->getAuthors(),
            'description' => $this->ReadBook->getDescription(),
            'title' => $this->ReadBook->getTitle(),
            'pages' => $this->ReadBook->getPages(),
            'year' => $this->ReadBook->getYear(),
        ]);

        $Book = (new BookStoreService(
            new BookRepository(),
            new AuthorRepository()
        ))->store($BookStoreDto);

        $saveBookContextAction = $this->bookContextRepository->store(
            $this->ReadBook->getContext(),
            $Book->toArray()['id']
        );

        $this->ReadBook->setContext([]);
        if ($saveBookContextAction) {
            event(new CreateMessageAfterStoreBookContextEvent($this->ReadBook));
        } else {
            event(new CreateMessageAfterStoreBookContextEvent($this->ReadBook, false));
        }
    }
}
