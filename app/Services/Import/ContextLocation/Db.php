<?php
declare(strict_types=1);

namespace App\Services\Import\ContextLocation;

use App\Events\Actions\PostBookCreateEvent;
use App\Exceptions\ExternalServiceException;
use App\Repositories\Eloquent\BookContextRepository;
use App\Repositories\Interfaces\BookContextRepositoryInterface;
use App\Traits\FileNameGenerate;
use App\ValueObjects\Book\ReadBookInterface;

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
