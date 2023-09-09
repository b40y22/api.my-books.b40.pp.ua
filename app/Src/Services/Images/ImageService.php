<?php
declare(strict_types=1);

namespace App\Src\Services\Images;

use App\Src\Common\File;
use App\Src\Services\Images\Interfaces\ImageServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;

class ImageService implements ImageServiceInterface
{


    /**
     * @param File $image
     * @return bool
     */
    public function uploadProfileImage(File $image): bool
    {
        try {
            $manager = new ImageManager(['driver' => 'imagick']);

            $manager->make($image->pathSource)->resize(48, 48)->save($image->pathDestination);
        } catch (Exception $e) {
            Log::error('[ImageService] has problem in uploadProfileImage');

            return false;
        }

        return true;
    }
}
