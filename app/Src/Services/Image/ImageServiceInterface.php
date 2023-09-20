<?php
declare(strict_types=1);

namespace App\Src\Services\Image;


use App\Src\StorageManager\StorageManagerInterface;
use App\Src\ValueObjects\File\File;

interface ImageServiceInterface
{
    /**
     * @param File $image
     * @param StorageManagerInterface $storageManager
     * @return bool
     */
    public function upload(File $image, StorageManagerInterface $storageManager): bool;

    /**
     * @param File $image
     * @param StorageManagerInterface $storageManager
     * @return bool
     */
    public function download(File $image, StorageManagerInterface $storageManager): string;
}
