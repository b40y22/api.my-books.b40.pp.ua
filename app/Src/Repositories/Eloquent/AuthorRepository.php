<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Models\Author;
use App\Src\Dto\Author\AuthorRemoveDto;
use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Dto\Author\AuthorUpdateDto;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthorRepository extends AbstractRepository implements AuthorRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Author::class);
    }

    /**
     * @param AuthorStoreDto $registerDto
     * @return Author|null
     */
    public function store(AuthorStoreDto $registerDto): ?Author
    {
        try {
            return Author::create([
                'firstname' => $registerDto->getFirstname(),
                'lastname' => $registerDto->getLastname(),
            ]);
        } catch (Throwable $e) {
            Log::error(__FUNCTION__, ['message' => $e->getMessage()]);
        }

        return null;
    }

    /**
     * @param AuthorUpdateDto $registerDto
     * @return bool|null
     */
    public function update(AuthorUpdateDto $registerDto): ?bool
    {
        $Author = $this->model::find($registerDto->getId());

        if (!$Author) {
            return null;
        }

        return $Author->update($registerDto->toArray());
    }

    /**
     * @param AuthorRemoveDto $authorRemoveDto
     * @return Author|null
     */
    public function remove(AuthorRemoveDto $authorRemoveDto): ?Author
    {
        $Author = $this->model::find($authorRemoveDto->getId());

        if (!$Author) {
            return null;
        }

        $Author->delete();

        return $Author;
    }

    /**
     * @param int $id
     * @return Author|null
     */
    public function get(int $id): ?Author
    {
        return $this->model::find($id) ?? null;
    }
}
