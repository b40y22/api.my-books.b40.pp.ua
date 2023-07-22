<?php
declare(strict_types=1);

namespace App\Src\Services\Auth;

use App\Models\User;
use App\Src\Dto\Auth\LoginDto;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use App\Src\Services\Auth\Interfaces\AuthServiceInterface;
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
