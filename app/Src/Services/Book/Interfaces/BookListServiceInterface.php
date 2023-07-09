<?php
declare(strict_types=1);

namespace App\Src\Services\Book\Interfaces;

interface BookListServiceInterface
{
    /**
     * @param array $request
     * @return array
     */
    public function list(array $request): array;
}
