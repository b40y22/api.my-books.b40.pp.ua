<?php
declare(strict_types=1);

namespace App\Src\StorageManager;

use App\Src\ValueObjects\File\File;

interface StorageManagerInterface
{
    public function store();
}
