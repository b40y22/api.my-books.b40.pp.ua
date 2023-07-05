<?php
declare(strict_types=1);

namespace App\Src\Repositories\Interfaces;

use App\Models\User;
use App\Src\Dto\Auth\RegisterDto;

interface UserRepositoryInterface extends AbstractRepositoryInterface
{
    /**
     * @param RegisterDto $registerDto
     * @return User|null
     */
    public function store(RegisterDto $registerDto): ?User;

    /**
     * @param string $column
     * @param string $values
     * @return mixed
     */
    public function getUserByColumn(string $column, string $values): mixed;
}
