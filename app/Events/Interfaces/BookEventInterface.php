<?php

namespace App\Events\Interfaces;

interface BookEventInterface
{
    /**
     * @return array
     */
    public function getMessageArray(): array;
}
