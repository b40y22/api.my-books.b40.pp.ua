<?php

namespace App\Events;

interface BookEventInterface
{
    /**
     * @return array
     */
    public function getMessageArray(): array;
}
