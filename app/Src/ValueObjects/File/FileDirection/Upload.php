<?php
declare(strict_types=1);

namespace App\Src\ValueObjects\File\FileDirection;

class Upload implements FileDirectionInterface
{
    const DIRECTION = 'upload';

    public ?string $destinationPath = null;
}
