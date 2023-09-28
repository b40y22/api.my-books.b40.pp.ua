<?php

namespace App\Src\ValueObjects\File\Direction;

class Create implements DirectionInterface
{
    /**
     * @var string|null
     */
    protected ?string $path = null;

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     * @return $this
     */
    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }
}
