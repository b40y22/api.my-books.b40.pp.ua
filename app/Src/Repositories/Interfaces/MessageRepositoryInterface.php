<?php
declare(strict_types=1);

namespace App\Src\Repositories\Interfaces;

interface MessageRepositoryInterface extends AbstractRepositoryInterface
{
    public function store(array $message);
}
