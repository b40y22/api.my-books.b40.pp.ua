<?php
declare(strict_types=1);

namespace App\Src\Services\Import\Parser;

use App\Src\Dto\Import\ImportBookDto;
use App\Src\Services\Import\ContextLocation\ContextLocationInterface;
use App\Src\Services\Import\Parser\Sources\SourceInterface;
use App\Src\Traits\HttpTrait;

final class ImportService implements ImportServiceInterface
{
    use HttpTrait;

    /**
     * @param ImportBookDto $importBookDto
     * @return mixed
     */
    public function importBook(ImportBookDto $importBookDto): mixed
    {
        $link = $importBookDto->getLinkArray()['link'];
        $type = $importBookDto->getLinkArray()['type'];

        // Parser name makes from part source site name
        /** @var SourceInterface $Parser **/
        $Parser = 'App\Src\Services\Import\Parser\Sources\\' . ucfirst($this->getDomain($link));

        /** @var ContextLocationInterface $Type **/
        $Type = 'App\Src\Services\Import\ContextLocation\\' . ucfirst($type);

        $Book = (new $Parser($link))->handle();
        return (new $Type($Book))->handle();
    }
}
