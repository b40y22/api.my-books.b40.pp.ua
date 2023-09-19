<?php
declare(strict_types=1);

namespace App\Src\ValueObjects\File;

use App\Src\ValueObjects\File\FileDirection\FileDirectionInterface;

class File
{
    /**
     * @var string
     */
    public string $filename = '';

    /**
     * @var string
     */
    public string $extension;

    /**
     * @var int
     */
    public int $size;

    /**
     * @var FileDirectionInterface
     */
    public FileDirectionInterface $direction;
}
