<?php
declare(strict_types=1);

namespace App\Src\Storages;

use App\Src\ValueObjects\File\File;

interface StorageInterface
{
    public function store(File $file);
}
