<?php
declare(strict_types=1);

namespace App\Services\File;

use App\Storages\StorageInterface;
use App\ValueObjects\File\File;

interface FileServiceInterface
{
    /**
     * @param File $file
     * @param StorageInterface $storage
     * @return mixed
     */
    public function download(File $file, StorageInterface $storage): mixed;

    /**
     * @param File $file
     * @param StorageInterface $storage
     * @return mixed
     */
    public function upload(File $file, StorageInterface $storage): mixed;
}
