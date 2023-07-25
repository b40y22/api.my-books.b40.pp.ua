<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

use App\Events\PostBookCreateEvent;
use App\Exceptions\ApiArgumentsException;
use App\Exceptions\ExternalServiceException;
use App\Src\Common\Books\Builder\BuilderBookInterface;
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
     * @param BuilderBookInterface $BookForStore
     * @param int $userId
     */
    public function __construct(
        protected BuilderBookInterface $BookForStore,
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
            'authors' => $this->BookForStore->getAuthors(),
            'description' => $this->BookForStore->getDescription(),
            'title' => $this->BookForStore->getTitle(),
            'pages' => $this->BookForStore->getPages(),
            'year' => $this->BookForStore->getYear(),
        ]);

        $Book = (new BookStoreService(
            new BookRepository(),
            new AuthorRepository()
        ))->store($BookStoreDto);

        // For create new message about new book
        event(new PostBookCreateEvent($Book));

        $this->bookContextRepository->store(
            $this->BookForStore->getContext(),
            $Book->toArray()['id']
        );
    }
}
