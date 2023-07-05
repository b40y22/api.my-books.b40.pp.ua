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

    /**
     * @param string $column
     * @param string $values
     * @return mixed
     */
    public function getUserByColumn(string $column, string $values): mixed;
}
