<?php
declare(strict_types=1);

namespace App\Src\Storages;

use App\Src\ValueObjects\File\File;
use App\Src\ValueObjects\File\Image\Image;

class LocalStorage implements StorageInterface
{
    /**
     * @param File $file
     * @return void
     */
    public function store(File $file): void
    {
        if ($file instanceof Image) {
            $file
                ->getContext()
                ->save(
                    public_path($file->getDestinationPath())
                );
            chown(public_path($file->getDestinationPath()), 'www-data');
            chgrp(public_path($file->getDestinationPath()), 'www-data');

            $file->setFileUrl(env('APP_URL') . substr($file->getDestinationPath(), 1));
        }
    }
}
