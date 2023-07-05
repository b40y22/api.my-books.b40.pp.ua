<?php

namespace App\Src\Repositories\Eloquent;

use App\Models\User;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @param array $userValidatedData
     * @return User|null
     */
    public function store(array $userValidatedData): ?User
    {
        try {
            return User::create([
                'name' => $userValidatedData['name'],
                'email' => $userValidatedData['email'],
                'password' => Hash::make($userValidatedData['password']),
            ]);
        } catch (Throwable $e) {
            Log::error(__FUNCTION__, ['message' => $e->getMessage()]);
        }

        return null;
    }

    /**
     * @param string $column
     * @param string $values
     * @return mixed
     */
    public function getUserByColumn(string $column, string $values): mixed
    {
        return $this->model::where($column, $values)->first();
    }
}
