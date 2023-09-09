<?php

namespace App\Src\Services\User\Interfaces;

use App\Src\Dto\User\UserUpdateDto;

interface UserUpdateServiceInterface
{
    /**
     * @param UserUpdateDto $userUpdateDto
     * @return array|null
     */
    public function update(UserUpdateDto $userUpdateDto): ?array;
}
