<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Models\Author;
use App\Src\Dto\Author\AuthorRemoveDto;
use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Dto\Author\AuthorUpdateDto;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthorRepository extends AbstractRepository implements AuthorRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Author::class);
    }

    /**
     * @param AuthorStoreDto $authorStoreDto
     * @return Author
     */
    public function store(AuthorStoreDto $authorStoreDto): Author
    {
        return $this->model::create(array_merge($authorStoreDto->toArray(), ['user_id' => Auth::id()]));
    }

    /**
     * @param AuthorUpdateDto $authorUpdateDto
     * @return bool|null
     */
    public function update(AuthorUpdateDto $authorUpdateDto): ?bool
    {
        $Author = $this->model::find($authorUpdateDto->getId());

        if (!$Author) {
            return null;
        }

        return $Author->update($authorUpdateDto->toArray());
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

    /**
     * @param AuthorStoreDto $authorStoreDto
     * @return Author|null
     */
    public function createIfNotExist(AuthorStoreDto $authorStoreDto): ?Author
    {
        $author = $authorStoreDto->toArray();

        return $this->model::firstOrCreate([
            'user_id' => Auth::id(),
            'firstname' => $author['firstname'],
            'lastname' => $author['lastname'],
        ]);
    }
}
