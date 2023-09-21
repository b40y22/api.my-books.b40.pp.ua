<?php
declare(strict_types=1);

namespace App\Src\ValueObjects\File\Image;

use App\Src\ValueObjects\File\File;

class Image extends File
{
    /**
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }
}
