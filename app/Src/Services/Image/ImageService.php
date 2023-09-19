<?php
declare(strict_types=1);

namespace App\Src\Services\Image;

use App\Src\StorageManager\StorageManagerInterface;
use App\Src\ValueObjects\File\File;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;

class ImageService implements ImageServiceInterface
{
    /**
     * @param File $image
     * @param StorageManagerInterface $storageManager
     * @return bool
     */
    public function upload(File $image, StorageManagerInterface $storageManager): bool
    {
        /*
         * 1. Валідація
         * 2. Отримання
         * 3. Обробка
         * 4. Збереження
         */
        return true;
    }

    /**
     * @param File $image
     * @param StorageManagerInterface $storageManager
     * @return bool
     */
    public function download(File $image, StorageManagerInterface $storageManager): bool
    {

        return true;
    }
}
