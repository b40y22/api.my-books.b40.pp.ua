<?php
declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\AbstractRepositoryInterface;

class AbstractRepository implements AbstractRepositoryInterface
{
    /**
     * @var string
     */
    protected string $model;

    /**
     * @param string $model
     */
    public function __construct(string $model)
    {
        $this->model = $model;
    }
}
