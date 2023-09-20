<?php
declare(strict_types=1);

namespace App\Src\StorageManager;

use App\Src\ValueObjects\File\File;
use Intervention\Image\Facades\Image;

class LocalManager implements StorageManagerInterface
{
    public function store(File $image): void
    {
        $pathByDefault = public_path('/images/books/') . $image->getFullFilename();

        Image::make('/tmp/' . $image->getFullFilename())
            ->resize(200, 300)
            ->save($image->direction->destinationPath . $image->getFullFilename() ?? $pathByDefault);
    }
}
