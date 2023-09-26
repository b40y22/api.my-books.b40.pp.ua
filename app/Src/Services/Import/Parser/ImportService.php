<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser;

use App\Src\Dto\Import\ImportBookDto;
use App\Src\Services\File\FileService;
use App\Src\Services\Import\ContextLocation\ContextLocationInterface;
use App\Src\Storages\LocalStorage;
use App\Src\Traits\HttpTrait;
use App\Src\ValueObjects\Book\ReadBook;
use App\Src\ValueObjects\File\Direction\Download;
use App\Src\ValueObjects\File\Image\Image;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

final class ImportService implements ImportServiceInterface
{
    use HttpTrait;

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
        $Book = (new $Parser($link))->handle();
        $this->makeBookCover($Book);

        return (new $Type($Book, $importBookDto->getUserId()))->handle();
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    protected function makeBookCover(ReadBook $book): void
    {
        $direction = (new Download())->setDownloadLink($book->getImage());

        $image = (new Image())
            ->newFilename()
            ->setExtension(pathinfo($direction->getDownloadLink(), PATHINFO_EXTENSION))
            ->setSourcePath()
            ->setDestinationPath('/images/books')
            ->setWidth(200)
            ->setHeight(300)
            ->setDirection($direction);

        (new FileService())
            ->download($image, new LocalStorage());
    }
}
