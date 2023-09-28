<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

use App\Models\Book;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Repositories\Eloquent\AuthorRepository;
use App\Src\Repositories\Eloquent\BookRepository;
use App\Src\Services\Book\BookStoreService;
use App\Src\ValueObjects\Book\ReadBookInterface;
use Illuminate\Support\Facades\Log;

abstract class AbstractStoreBook
{
    /**
     * @param ReadBookInterface $readBook
     * @param array $additionalInformation
     * @return Book|null
     */
    protected function basicStoreBook(ReadBookInterface $readBook, array $additionalInformation): ?Book
    {
        try {
            $BookStoreDto = new BookStoreDto([
                'authors' => $readBook->getAuthors(),
                'description' => $readBook->getDescription(),
                'title' => $readBook->getTitle(),
                'pages' => $readBook->getPages(),
                'year' => $readBook->getYear(),

                'user_id' => $additionalInformation['user_id'] ?? null,
                'files' => $additionalInformation['files'] ?? null,
            ]);

            return (new BookStoreService(
                new BookRepository(),
                new AuthorRepository()
            ))->store($BookStoreDto);
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::error('[AbstractStoreBook:basicStoreBook]', ['store was wrong']);
        }

        return null;
    }
}
