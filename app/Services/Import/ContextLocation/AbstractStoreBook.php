<?php
declare(strict_types=1);

namespace App\Services\Import\ContextLocation;

use App\Dto\Book\BookStoreDto;
use App\Models\Book;
use App\Repositories\Eloquent\AuthorRepository;
use App\Repositories\Eloquent\BookRepository;
use App\Services\Book\BookStoreService;
use App\ValueObjects\Book\ReadBookInterface;
use App\ValueObjects\File\Direction\Create;
use App\ValueObjects\File\Pdf\Pdf as PdfFile;
use Exception;
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
                'files' => $readBook->getFilesAsArray() ?? null,
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

    /**
     * @param string $filename
     * @return PdfFile
     * @throws Exception
     */
    protected function createPdfObject(string $filename): PdfFile
    {
        $direction = (new Create())->setPath('/books/' . PdfFile::makeFullFilename($filename));

        return (new PdfFile())
            ->setFilename($filename)
            ->setExtension(PdfFile::EXTENSION)
            ->setSourcePath()
            ->setDestinationPath('/books')
            ->setDirection($direction);
    }
}
