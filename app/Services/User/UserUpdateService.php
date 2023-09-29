<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Dto\User\UserUpdateDto;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\UserUpdateServiceInterface;

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
