<?php
declare(strict_types=1);

namespace App\Dto;

abstract class AbstractDto
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
