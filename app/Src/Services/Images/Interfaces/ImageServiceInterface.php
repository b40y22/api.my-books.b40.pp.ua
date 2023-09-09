<?php

namespace App\Src\Services\Images\Interfaces;

use App\Src\Common\File;

interface ImageServiceInterface
{
    public function uploadProfileImage(File $image): bool;
}
