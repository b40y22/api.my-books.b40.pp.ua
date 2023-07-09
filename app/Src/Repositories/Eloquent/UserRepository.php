<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Models\User;
use App\Src\Dto\Auth\RegisterDto;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @param RegisterDto $registerDto
     * @return User|null
     */
    public function store(RegisterDto $registerDto): ?User
    {
        try {
            return $this->model::create($registerDto->toArray());
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
