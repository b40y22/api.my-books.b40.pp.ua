<?php

namespace App\Services\User\Interfaces;

use App\Dto\User\UserUpdateDto;

interface UserUpdateServiceInterface
{
    /**
     * @param UserUpdateDto $userUpdateDto
     * @return array|null
     */
    public function update(UserUpdateDto $userUpdateDto): ?array;
}
