<?php
declare(strict_types=1);

namespace App\Src\Services\File;

use App\Src\Storages\StorageInterface;
use App\Src\ValueObjects\File\File;
use App\Src\ValueObjects\File\Image\Image as VOImage;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Intervention\Image\ImageManager;

class FileService implements FileServiceInterface
{
    /**
     * @param File $file
     * @param StorageInterface $storage
     * @return File
     * @throws GuzzleException
     * @throws Exception
     */
    public function download(File $file, StorageInterface $storage): File
    {
        $response = (new Client())->request(
            'GET',
            $file->getDirection()->getDownloadLink(),
            ['sink' => $file->getSourcePath()]
        );

        if ($response->getStatusCode() !== 200) {
            throw new Exception('[FileService:download] response status code not equal 200');
        }

        if ($file instanceof VOImage) {
            $manager = new ImageManager(['driver' => 'imagick']);
            $file->setContext(
                $manager->make($file->getSourcePath())
                    ->resize($file->getWidth(), $file->getHeight())
                );
        }

        $storage->store($file);

        return $file;
    }

    /**
     * @param File $file
     * @param StorageInterface $storage
     * @return mixed
     */
    public function upload(File $file, StorageInterface $storage): mixed
    {
        if ($file instanceof VOImage) {
            $manager = new ImageManager(['driver' => 'imagick']);
            $file->setContext(
                $manager->make($file->getSourcePath())
                    ->resize($file->getWidth(), $file->getHeight())
            );
        }

        $storage->store($file);

        return $file;
    }
}
