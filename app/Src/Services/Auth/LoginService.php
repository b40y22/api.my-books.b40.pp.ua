<?php

namespace App\Src\Services\Auth;

use App\Models\User;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class LoginService implements AuthServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * @param array $requestArray
     * @return ?User
     */
    public function login(array $requestArray): ?User
    {
        $User = $this->userRepository->getUserByColumn('email', $requestArray['email']);

        if(!$User || !Hash::check($requestArray['password'], $User->password)) {
            return null;
        }

        return $User;
    }
}
