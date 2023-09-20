<?php
declare(strict_types=1);

namespace App\Src\ValueObjects\File;

use App\Src\Traits\FileNameGenerate;
use App\Src\ValueObjects\File\FileDirection\FileDirectionInterface;

class File
{
    use FileNameGenerate;

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

    /**
     * @return $this
     */
    public function newFilename(): self
    {
        $this->filename = $this->generateFilename();

        return $this;
    }

    /**
     * @return string
     */
    public function getFullFilename(): string
    {
        return $this->filename . '.' . $this->extension;
    }
}
