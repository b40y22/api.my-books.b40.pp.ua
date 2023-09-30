<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Dto\User\UserUpdateDto;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Interfaces\UserUpdateServiceInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class UserUpdateService implements UserUpdateServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function update(UserUpdateDto $userUpdateDto): ?array
    {
        try {
            $this->userRepository->update($userUpdateDto);

            return $this->userRepository->get($userUpdateDto->getId());
        } catch (Exception $e) {
            Log::error('[UserUpdateService:update]', ['update action was wrong']);
        }

        return null;
    }
}
