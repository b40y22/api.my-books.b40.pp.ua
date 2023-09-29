<?php
declare(strict_types=1);

namespace App\ValueObjects\File\Pdf;

use App\ValueObjects\File\File;

class Pdf extends File
{
    const EXTENSION = 'pdf';

    /**
     * @param string $filename
     * @return string
     */
    public static function makeFullFilename(string $filename): string
    {
        return $filename . '.' . self::EXTENSION;
    }
}
