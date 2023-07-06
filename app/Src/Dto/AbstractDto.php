<?php

namespace App\Src\Dto;

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
