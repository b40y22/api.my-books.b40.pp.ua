<?php
declare(strict_types=1);

namespace App\Src\ValueObjects\File;

use App\Src\Traits\FileNameGenerate;
use App\Src\ValueObjects\File\Direction\DirectionInterface;
use Exception;

class File
{
    use FileNameGenerate;

    /**
     * @var string|null
     */
    protected ?string $filename = null;

    /**
     * @var string|null
     */
    protected ?string $extension = null;

    /**
     * @var string|null
     */
    protected ?string $sourcePath = null;

    /**
     * @var string|null
     */
    protected ?string $destinationPath = null;

    /**
     * @var int|null
     */
    protected ?int $size = null;

    /**
     * @var DirectionInterface
     */
    protected DirectionInterface $direction;

    /**
     * @var mixed
     */
    protected mixed $context;

    /**
     * @var string|null
     */
    protected ?string $fileUrl = null;

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getSourcePath(): ?string
    {
        return $this->sourcePath;
    }

    /**
     * @param string $sourcePath
     * @return $this
     * @throws Exception
     */
    public function setSourcePath(string $sourcePath = '/tmp'): self
    {
        if (!$this->filename) {
            throw new Exception('[File:setSourcePath] param filename must be initialization before use');
        }
        if (!$this->extension) {
            throw new Exception('[File:setSourcePath] param extension must be initialization before use');
        }

        $this->sourcePath = $sourcePath === '/tmp'
            ? $sourcePath . DIRECTORY_SEPARATOR . $this->filename . '.' . $this->extension
            : $sourcePath;

        return $this;
    }

    public function getDestinationPath(): ?string
    {
        return $this->destinationPath;
    }

    /**
     * @param string $destinationPath
     * @return $this
     * @throws Exception
     */
    public function setDestinationPath(string $destinationPath): self
    {
        if (!$this->filename) {
            throw new Exception('[File:setDestinationPath] param filename must be initialization before use');
        }
        if (!$this->extension) {
            throw new Exception('[File:setSourcePath] param extension must be initialization before use');
        }

        $this->destinationPath = $destinationPath . DIRECTORY_SEPARATOR . $this->filename . '.' . $this->extension;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDirection(): DirectionInterface
    {
        return $this->direction;
    }

    /**
     * @param DirectionInterface $direction
     * @return $this
     */
    public function setDirection(DirectionInterface $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return $this
     */
    public function newFilename(): self
    {
        $this->filename = $this->generateFilename();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContext(): mixed
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     * @return $this
     */
    public function setContext(mixed $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(?string $fileUrl): void
    {
        $this->fileUrl = $fileUrl;
    }

    /**
     * @throws Exception
     */
    public function getFullFilename(): string
    {
        if (!$this->filename) {
            throw new Exception('[File:setDestinationPath] param filename must be initialization before use');
        }
        if (!$this->extension) {
            throw new Exception('[File:setSourcePath] param extension must be initialization before use');
        }

        return $this->filename . '.' . $this->extension;
    }

    /**
     * @throws Exception
     */
    public function toArray(): array
    {
        return [
            'fileUrl' => $this->getFileUrl(),
            'filename' => $this->getFullFilename()
        ];
    }
}
