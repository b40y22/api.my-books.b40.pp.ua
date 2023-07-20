<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Exceptions\ExternalServiceException;
use App\Models\BookContext;
use App\Src\Repositories\Interfaces\BookContextRepositoryInterface;
use App\Src\Traits\ErrorResponseTrait;

class BookContextRepository extends AbstractRepository implements BookContextRepositoryInterface
{
    use ErrorResponseTrait;

    public function __construct()
    {
        parent::__construct(BookContext::class);
    }

    /**
     * @param array $bookContext
     * @param int $bookId
     * @return bool
     * @throws ExternalServiceException
     */
    public function store(array $bookContext, int $bookId): bool
    {
        if (count($bookContext) < 1) {
            throw new ExternalServiceException();
        }

        $resultForStore = [];
        foreach ($bookContext as $page => $text) {
            $resultForStore[] = [
                'book_id' => $bookId,
                'page' => $page + 1,
                'text' => json_encode($text, JSON_UNESCAPED_UNICODE)
            ];
        }

        return $this->model::insert($resultForStore);
    }
}
