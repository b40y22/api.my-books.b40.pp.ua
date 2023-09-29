<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Dto\Auth\LoginDto;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class LoginService implements AuthServiceInterface
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * @param LoginDto $requestDto
     * @return ?User
     */
    public function login(LoginDto $requestDto): ?User
    {
        $User = $this->userRepository->getUserByColumn('email', $requestDto->getEmail());

        if(!$User || !Hash::check($requestDto->getPassword(), $User->password)) {
            return null;
        }

        return $User;
    }
}
