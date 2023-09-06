<?php
declare(strict_types=1);

namespace App\Src\Dto\Import;

use App\Src\Dto\AbstractDto;
use Illuminate\Support\Facades\Auth;

class ImportBookDto extends AbstractDto
{
    /**
     * @var int
     */
    protected int $userId;

    /**
     * @var string
     */
    protected string $link;

    /**
     * @var string
     */
    protected string $type;

    public function __construct(array $requestForImport)
    {
        $this->link = $requestForImport['link'];
        $this->type = $requestForImport['type'];
        $this->userId = Auth::id();
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
