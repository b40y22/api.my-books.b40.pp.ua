<?php
declare(strict_types=1);

namespace App\Src\Services\Book;

use App\Exceptions\ApiArgumentsException;
use App\Src\Dto\Book\Author\AuthorFromBookDto;
use Illuminate\Support\Facades\Log;

abstract class AbstractBookService
{
    /**
     * @throws ApiArgumentsException
     */
    public function formatAuthorsArray(array $requestAuthors): array
    {
        $authors = [];

        /** @var AuthorFromBookDto $Author */
        foreach ($requestAuthors as $Author) {
            if ($Author->isNew()) {
                $authors[] = $this->authorRepository->store($Author)->toArray();
            } else {
                if ($Author->getId() < 1) {
                    Log::error('Author ID cannot be less than 1', $Author->toArray());

                    throw new ApiArgumentsException(trans('api.general.failed'), 400);
                }
                $authors[] = $this->authorRepository->get($Author->getId())->toArray();
            }
        }

        return $authors;
    }
}
