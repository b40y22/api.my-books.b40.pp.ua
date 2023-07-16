<?php
declare(strict_types=1);

namespace App\Src\Services\Import\ContextLocation;

use App\Src\Common\Books\Builder\ReadBook;
use App\Src\Traits\FileNameGenerate;

class Pdf implements ContextLocationInterface
{
    use FileNameGenerate;

    /**
     * @param ReadBook $ReadBook
     */
    public function __construct(
        protected ReadBook $ReadBook
    ) {}

    /**
     * @return bool
     */
    public function handle(): bool
    {
        //
        return false;
    }
}
