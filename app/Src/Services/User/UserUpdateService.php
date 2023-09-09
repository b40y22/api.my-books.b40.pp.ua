<?php
declare(strict_types=1);

namespace App\Src\Services\User;

use App\Src\Dto\User\UserUpdateDto;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use App\Src\Services\Images\Interfaces\ImageServiceInterface;
use App\Src\Services\User\Interfaces\UserUpdateServiceInterface;

class UserUpdateService implements UserUpdateServiceInterface
{
    public function __construct(
        protected ImageServiceInterface $imageService,
        protected UserRepositoryInterface $userRepository
    ) {}

    public function update(UserUpdateDto $userUpdateDto): ?array
    {
        // TODO потрібно перед створенням нового зображення видаляти старе
        if ($userUpdateDto->getImage()) {
            $this->imageService->uploadProfileImage($userUpdateDto->getImage());
        }

        $this->userRepository->update($userUpdateDto);

        return $this->userRepository->get($userUpdateDto->getId());
    }
}
