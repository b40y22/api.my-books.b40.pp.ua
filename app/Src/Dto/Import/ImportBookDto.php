<?php
declare(strict_types=1);

namespace App\Src\Dto\Import;

use App\Src\Dto\AbstractDto;

class ImportBookDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $user_id;

    /**
     * @param array $linkArray
     */
    public function __construct(
        protected array $linkArray
    ) {}

    /**
     * @return array
     */
    public function getLinkArray(): array
    {
        return $this->linkArray;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}
