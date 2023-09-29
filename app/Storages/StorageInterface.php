<?php
declare(strict_types=1);

namespace App\Storages;

use App\ValueObjects\File\File;

interface StorageInterface
{
    public function store(File $file);
}
