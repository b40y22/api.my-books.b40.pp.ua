<?php

namespace App\Listeners;

use App\Events\CreateMessageAfterStoreBookContextEvent;

class CreateMessageAfterStoreBookContextListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateMessageAfterStoreBookContextEvent $event): void
    {

    }
}
