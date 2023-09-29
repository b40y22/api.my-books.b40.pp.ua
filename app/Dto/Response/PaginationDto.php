<?php
declare(strict_types=1);

namespace App\Dto\Response;

use App\Dto\AbstractDto;

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
    public array $items = [];
}
