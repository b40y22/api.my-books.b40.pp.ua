<?php

namespace App\Listeners;

use App\Events\PostBookCreateEvent;

class PostBookCreateListener
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
    public function handle(PostBookCreateEvent $event): void
    {
        // TODO: потрібно створити міграцію, модел, репозіторій для таблиці messages
        // Звідси буду дергати метод який буде записувати нову книжку до таблиці messages
    }
}
