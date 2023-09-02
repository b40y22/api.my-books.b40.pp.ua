<?php

namespace App\Src\Dto\ExternalSource;

use App\Src\Dto\AbstractDto;

class ExternalSourceStoreDto extends AbstractDto
{
    /**
     * @var string
     */
    protected string $title;

    /**
     * @var bool
     */
    protected bool $active;

    /**
     * @var string
     */
    protected string $url;

    /**
     * @var string
     */
    protected string $class_name;

    /**
     * @var int|null
     */
    protected ?int $status;

    public function __construct(array $source)
    {
        $this->active = $source['active'];
        $this->class_name = $source['class_name'];
        $this->title = $source['title'];
        $this->url = $source['url'];
        $this->status = null;
    }
}
