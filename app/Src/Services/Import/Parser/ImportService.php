<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser;

use App\Src\Dto\Import\ImportBookDto;
use App\Src\Services\Image\ImageService;
use App\Src\Services\Import\ContextLocation\ContextLocationInterface;
use App\Src\StorageManager\LocalManager;
use App\Src\Traits\HttpTrait;
use App\Src\ValueObjects\File\FileDirection\Download;
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

        $Book = (new $Parser($link))->handle(); // TODO перевірка на наявність класа
        $this->storeBookCover($Book->getImage());

        return (new $Type($Book, $importBookDto->getUserId()))->handle();
    }

    /**
     * @throws Exception
     * @throws GuzzleException
     */
    protected function storeBookCover(string $imageLink): void
    {
        $direction = new Download();
        $direction->downloadLink = $imageLink;
        $direction->destinationPath = public_path('/images/books/');

        $image = new Image();
        $image->newFilename();
        $image->direction = $direction;
        $image->extension = pathinfo($direction->downloadLink, PATHINFO_EXTENSION);

        $downloadResult = (new ImageService())->download($image, new LocalManager());
    }
}
