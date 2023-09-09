<?php
declare(strict_types=1);

namespace App\Src\Repositories\Interfaces;

use App\Models\User;
use App\Src\Dto\Auth\RegisterDto;
use App\Src\Dto\User\UserUpdateDto;

interface UserRepositoryInterface extends AbstractRepositoryInterface
{
    /**
     * @param int $id
     * @return array|null
     */
    public function get(int $id): ?array;

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

    /**
     * @param UserUpdateDto $userUpdateDto
     * @return bool|null
     */
    public function update(UserUpdateDto $userUpdateDto): ?bool;
}
