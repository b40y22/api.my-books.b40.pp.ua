<?php
declare(strict_types=1);

namespace App\Src\ValueObjects\File\FileDirection;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Download implements FileDirectionInterface
{
    const DIRECTION = 'download';
    public string $downloadLink = '';

    /**
     * @return $this
     * @throws Exception
     */
    public function checkLink(): self
    {
        if (!$this->downloadLink) {
            throw new Exception('Link for download must be setup before use');
        }

        return $this;
    }
}
