<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dto\Auth\RegisterDto;
use App\Dto\User\UserUpdateDto;
use App\Models\User;

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
