<?php

namespace App\Listeners;

use App\Events\PostBookCreateEvent;
use App\Src\Repositories\Interfaces\MessageRepositoryInterface;

class PostBookCreateListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected MessageRepositoryInterface $messageRepository
    ) {}

    /**
     * Handle the event.
     */
    public function handle(PostBookCreateEvent $event): void
    {
        $messageArrayData = $event->getMessageArray();

        $this->messageRepository->store([
            'message' => $messageArrayData,
            'action' => 'newBook',
            'read' => false
        ]);
    }
}
