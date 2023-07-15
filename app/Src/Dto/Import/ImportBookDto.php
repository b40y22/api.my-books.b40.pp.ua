<?php
declare(strict_types=1);

namespace App\Src\Dto\Import;

use App\Src\Dto\AbstractDto;

class ImportBookDto extends AbstractDto
{
    /**
     * @param array $linkArray
     */
    public function __construct(
        protected array $linkArray
    ) {}

    /**
     * @return array
     */
    public function getLinkArray(): array
    {
        return $this->linkArray;
    }
}
