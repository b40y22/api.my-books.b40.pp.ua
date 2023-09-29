<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface MessageRepositoryInterface extends AbstractRepositoryInterface
{
    public function store(array $message);
}
