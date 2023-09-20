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
        return true;
    }

    /**
     * @param File $image
     * @param StorageManagerInterface $storageManager
     * @return bool
     * @throws GuzzleException
     * @throws Exception
     */
    public function download(File $image, StorageManagerInterface $storageManager): string
    {
        if ($image->direction->downloadLink) {
            $response = (new Client())->request(
                'GET',
                $image->direction->downloadLink,
                ['sink' => '/tmp/' . $image->getFullFilename()]
            );

            if (200 !== $response->getStatusCode()) {
                throw new Exception('[ImageService:download] has response code not equal 200');
            }

            $storageManager->store($image);
        }

        return '';
    }
}
