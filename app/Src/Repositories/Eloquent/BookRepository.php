<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Exceptions\ApiArgumentsException;
use App\Models\Book;
use App\Src\Dto\Book\BookRemoveDto;
use App\Src\Dto\Book\BookStoreDto;
use App\Src\Dto\Book\BookUpdateDto;
use App\Src\Dto\Response\PaginationDto;
use App\Src\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class BookRepository extends AbstractRepository implements BookRepositoryInterface
{
    const PER_PAGE_DEFAULT = 15;

    public function __construct()
    {
        parent::__construct(Book::class);
    }

    /**
     * @param BookStoreDto $bookStoreDto
     * @return Book
     */
    public function store(BookStoreDto $bookStoreDto): Book
    {
        return $this->model::create($bookStoreDto->toArray());
     }

    /**
     * @param int $id
     * @param array $options
     * @return array|null
     */
    public function get(int $id, array $options = []): ?array
    {
        if (isset($options['with'])) {
            $Book = $this->model::where(['id' => $id, 'user_id' => Auth::id()])->with($options['with'])->first();
        } else {
            $Book = $this->model::where(['id' => $id, 'user_id' => Auth::id()])->first();
        }

        if ($Book) {
            $Book = $Book->toArray();
            ksort($Book);

            return $Book;
        }

        return null;
    }

    /**
     * @param BookUpdateDto $bookUpdateDto
     * @return bool|null
     */
    public function update(BookUpdateDto $bookUpdateDto): ?bool
    {
        $Book = $this->model::where([
            'id' => $bookUpdateDto->id,
            'user_id' => Auth::id()
        ])->first();

        if (!$Book) {
            return null;
        }

        return $Book->update($bookUpdateDto->toArray());
    }

    /**
     * @param int $bookId
     * @return Book|null
     */
    public function remove(int $bookId): ?Book
    {
        $Book = $this->model::where(['id' => $bookId, 'user_id' => Auth::id()])->first();

        if (!$Book) {
            return null;
        }

        $Book->delete();

        return $Book;
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
                    ->with('authors')
                    ->paginate($pagination->perPage);

            } catch (Throwable) {
                throw new ApiArgumentsException(trans('api.argument.failed'));
            }
        } else {
            $value = $this->model::where('user_id', Auth::id())
                ->with('authors')
                ->paginate($pagination->perPage);
        }

        $pagination->total = $value->total();
        $pagination->lastPage = $value->lastPage();
        $pagination->items = $value->items();

        return $pagination->toArray();
    }
}
