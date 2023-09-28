<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser;

use App\Src\Dto\Import\ImportBookDto;
use App\Src\Services\File\FileService;
use App\Src\Services\Import\ContextLocation\ContextLocationInterface;
use App\Src\Storages\LocalStorage;
use App\Src\Traits\HttpTrait;
use App\Src\ValueObjects\Book\ReadBook;
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
        $Parser = 'App\Src\Services\Import\Parser\Sources\\' . $this->getParserClassNameFromDomain($link);
        if (!class_exists($Parser)) {
            throw new Exception('Class ' . $Parser . ' not found');
        }

        /** @var ContextLocationInterface $Type **/
        $Type = 'App\Src\Services\Import\ContextLocation\\' . ucfirst($type);
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
