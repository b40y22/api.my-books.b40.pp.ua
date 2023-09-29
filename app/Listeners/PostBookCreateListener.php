<?php
declare(strict_types=1);

namespace App\Listeners;

use App\Events\Actions\PostBookCreateEvent;
use App\Repositories\Interfaces\MessageRepositoryInterface;

class PostBookCreateListener
{
    /**
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        protected MessageRepositoryInterface $messageRepository
    ) {}

    /**
     * @param PostBookCreateEvent $event
     * @return void
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
