<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Src\Repositories\Interfaces\AbstractRepositoryInterface;

class AbstractRepository implements AbstractRepositoryInterface
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @param string $model
     */
    public function __construct(string $model)
    {
        $this->model = $model;
    }
}
