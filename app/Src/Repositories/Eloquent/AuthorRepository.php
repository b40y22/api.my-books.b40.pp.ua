<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Exceptions\ApiArgumentsException;
use App\Models\Author;
use App\Src\Dto\Author\AuthorRemoveDto;
use App\Src\Dto\Author\AuthorStoreDto;
use App\Src\Dto\Author\AuthorUpdateDto;
use App\Src\Dto\Response\PaginationDto;
use App\Src\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthorRepository extends AbstractRepository implements AuthorRepositoryInterface
{
    const PER_PAGE_DEFAULT = 15;

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
        return $this->model::create($authorStoreDto->toArray());
    }

    /**
     * @param AuthorUpdateDto $authorUpdateDto
     * @return bool|null
     */
    public function update(AuthorUpdateDto $authorUpdateDto): ?bool
    {
        $Author = $this->model::where(['id' => $authorUpdateDto->getId(), 'user_id' => Auth::id()])->first();

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
        $Author = $this->model::where(['id' => $authorRemoveDto->getId(), 'user_id' => Auth::id()])->first();

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
        return $this->model::where(['id' => $id, 'user_id' => Auth::id()])->first() ?? null;
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

    /**
     * @param array $request
     * @return array|null
     * @throws ApiArgumentsException
     */
    public function list(array $request): ?array
    {
        $pagination = new PaginationDto();
        $pagination->currentPage = isset($request['currentPage']) ? (int) $request['currentPage'] : 1;
        $pagination->perPage = isset($request['perPage']) ? (int) $request['perPage'] : self::PER_PAGE_DEFAULT;

        // Build query by on params from request
        Paginator::currentPageResolver(function () use ($pagination) {
            return $pagination->currentPage;
        });

        // OrderBy
        if (isset($request['orderBy'])) {
            try {
                $orderByArray = explode(',', $request['orderBy']);
                $pagination->orderBy = [
                    'column' => $orderByArray[0],
                    'direction' => $orderByArray[1],
                ];

                $value = $this->model::where('user_id', Auth::id())
                    ->orderBy($pagination->orderBy['column'], $pagination->orderBy['direction'])
                    ->paginate($pagination->perPage);
            } catch (Throwable) {
                throw new ApiArgumentsException(trans('api.argument.failed'));
            }
        } else {
            $value = $this->model::where('user_id', Auth::id())
                ->paginate($pagination->perPage);
        }

        $pagination->total = $value->total();
        $pagination->lastPage = $value->lastPage();
        $pagination->items = $value->items();

        return $pagination->toArray();
    }
}
