<?php
declare(strict_types=1);

namespace App\Src\ValueObjects\File\Direction;

class Download implements DirectionInterface
{
    /**
     * @var string|null
     */
    protected ?string $downloadLink = null;

    /**
     * @return string|null
     */
    public function getDownloadLink(): ?string
    {
        return $this->downloadLink;
    }

    /**
     * @param string $downloadLink
     * @return $this
     */
    public function setDownloadLink(string $downloadLink): self
    {
        $this->downloadLink = $downloadLink;

        return $this;
    }
}
