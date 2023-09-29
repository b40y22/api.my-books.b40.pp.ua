<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface BookContextRepositoryInterface extends AbstractRepositoryInterface
{
    /**
     * @param array $bookContext
     * @param int $bookId
     * @return bool
     */
    public function store(array $bookContext, int $bookId): bool;
}
