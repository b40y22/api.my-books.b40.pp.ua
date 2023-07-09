<?php
declare(strict_types=1);

namespace App\Src\Services\Author\Interfaces;

interface AuthorListServiceInterface
{
    /**
     * @param array $request
     * @return array
     */
    public function list(array $request): array;
}
