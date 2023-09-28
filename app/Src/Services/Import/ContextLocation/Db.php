<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

use App\Events\Actions\PostBookCreateEvent;
use App\Exceptions\ApiArgumentsException;
use App\Exceptions\ExternalServiceException;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Repositories\Eloquent\AuthorRepository;
use App\Src\Repositories\Eloquent\BookContextRepository;
use App\Src\Repositories\Eloquent\BookRepository;
use App\Src\Repositories\Interfaces\BookContextRepositoryInterface;
use App\Src\Services\Book\BookStoreService;
use App\Src\Traits\FileNameGenerate;
use App\Src\ValueObjects\Book\ReadBookInterface;

class Db extends AbstractStoreBook implements ContextLocationInterface
{
    use FileNameGenerate;

    protected BookContextRepositoryInterface $bookContextRepository;

    /**
     * @param ReadBookInterface $BookForStore
     * @param int $userId
     */
    public function __construct(
        protected ReadBookInterface $BookForStore,
        protected int $userId
    ) {
        $this->bookContextRepository = new BookContextRepository();
    }

    /**
     * @return bool
     * @throws ExternalServiceException
     */
    public function handle(): bool
    {
        $Book = $this->basicStoreBook(
            $this->BookForStore,
            ['user_id' => $this->userId]
        );

        // For create new message about new book
        event(new PostBookCreateEvent($Book));

        $this->bookContextRepository->store(
            $this->BookForStore->getContext(),
            $Book->toArray()['id']
        );

        return true;
    }
}
