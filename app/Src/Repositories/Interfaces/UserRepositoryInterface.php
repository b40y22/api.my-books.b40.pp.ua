<?php

namespace App\Src\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface extends AbstractRepositoryInterface
{
    /**
     * @param array $userValidatedData
     * @return User|null
     */
    public function store(array $userValidatedData): ?User;
}
