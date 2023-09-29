<?php
declare(strict_types=1);

namespace App\Services\Import\Parser;

use App\Dto\Import\ImportBookDto;
use App\Services\File\FileService;
use App\Services\Import\ContextLocation\ContextLocationInterface;
use App\Storages\LocalStorage;
use App\Traits\HttpTrait;
use App\ValueObjects\Book\ReadBook;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

final class ImportService implements ImportServiceInterface
{
    use HttpTrait;

    /**
     * @var ReadBook
     */
    private ReadBook $book;

    /**
     * @param ImportBookDto $importBookDto
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function importBook(ImportBookDto $importBookDto): bool
    {
        $link = $importBookDto->getLink();
        $type = $importBookDto->getType();

        // Parser name makes from part source site name
        $Parser = 'App\Services\Import\Parser\Sources\\' . $this->getParserClassNameFromDomain($link);
        if (!class_exists($Parser)) {
            throw new Exception('Class ' . $Parser . ' not found');
        }

        /** @var ContextLocationInterface $Type **/
        $Type = 'App\Services\Import\ContextLocation\\' . ucfirst($type);
        /** @var ReadBook $Book */
        $this->book = (new $Parser($link))->handle();
        $this->makeBookCover();

        return (new $Type($this->book, $importBookDto->getUserId()))->handle();
    }

    /**
     * @return void
     * @throws GuzzleException
     */
    protected function makeBookCover(): void
    {
        (new FileService())
            ->download(
                $this->book->getFiles()['image'],
                new LocalStorage()
            );
    }
}
