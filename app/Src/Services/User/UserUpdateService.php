<?php
declare(strict_types=1);

namespace App\Src\Services\User;

use App\Src\Dto\User\UserUpdateDto;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use App\Src\Services\User\Interfaces\UserUpdateServiceInterface;

class UserUpdateService implements UserUpdateServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function update(UserUpdateDto $userUpdateDto): ?array
    {
        $this->userRepository->update($userUpdateDto);

        return $this->userRepository->get($userUpdateDto->getId());
    }
}
