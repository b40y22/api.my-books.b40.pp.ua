<?php
declare(strict_types=1);

namespace App\Src\Common;

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
     * @var string|null
     */
    public ?string $pathSource = null;

    /**
     * @var string|null
     */
    public ?string $pathDestination = null;
}
