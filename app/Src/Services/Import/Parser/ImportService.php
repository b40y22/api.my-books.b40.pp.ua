<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser;

use App\Src\Dto\Import\ImportBookDto;
use App\Src\Services\Import\ContextLocation\ContextLocationInterface;
use App\Src\Traits\HttpTrait;
use Mockery\Exception;

final class ImportService implements ImportServiceInterface
{
    use HttpTrait;

    /**
     * @param ImportBookDto $importBookDto
     * @return bool
     */
    public function importBook(ImportBookDto $importBookDto): bool
    {
        $link = $importBookDto->getLink();
        $type = $importBookDto->getType();

        // Parser name makes from part source site name
        $Parser = 'App\Src\Services\Import\Parser\Sources\\' . ucfirst($this->getDomain($link));
        if (!class_exists($Parser)) {
            throw new Exception('Class ' . $Parser . ' not found');
        }

        /** @var ContextLocationInterface $Type **/
        $Type = 'App\Src\Services\Import\ContextLocation\\' . ucfirst($type);

        $Book = (new $Parser($link))->handle(); // TODO перевірка на наявність класа

        return (new $Type($Book, $importBookDto->getUserId()))->handle();
    }
}
