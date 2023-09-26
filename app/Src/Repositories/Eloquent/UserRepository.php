<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Models\User;
use App\Src\Dto\Auth\RegisterDto;
use App\Src\Dto\User\UserUpdateDto;
use App\Src\Repositories\Interfaces\UserRepositoryInterface;
use App\Src\Traits\ErrorResponseTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    use ErrorResponseTrait;

    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @param int $id
     * @return array|null
     * @throws Exception
     */
    public function get(int $id): ?array
    {
        if ($id !== Auth::id()) {
            throw new Exception('Access denied');
        }

        $User = $this->model::where(['id' => $id])->first();

        if ($User) {
            $User = $User->toArray();
            ksort($User);

            return $User;
        }

        return null;
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

    /**
     * @param UserUpdateDto $userUpdateDto
     * @return bool|null
     * @throws Exception
     */
    public function update(UserUpdateDto $userUpdateDto): ?bool
    {
        $User = $this->model::where(['id' => $userUpdateDto->getId()])->first();

        if (!$User) {
            return null;
        }

        return $User->update(
            $userUpdateDto->toArrayNotNullFields()
        );
    }
}
