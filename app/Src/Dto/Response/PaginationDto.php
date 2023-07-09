<?php
declare(strict_types=1);

namespace App\Src\Dto\Response;

use App\Src\Dto\AbstractDto;

class PaginationDto extends AbstractDto
{
    /**
     * @var int|null
     */
    public ?int $currentPage;

    /**
     * @var int|null
     */
    public ?int $perPage;

    /**
     * @var int|null
     */
    public ?int $total;

    /**
     * @var int|null
     */
    public ?int $lastPage;

    /**
     * @var array
     */
    public array $orderBy = [];

    /**
     * @var array
     */
    public array $list = [];
}
