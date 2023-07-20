<?php

namespace App\Events;

use App\Src\Common\Books\Builder\BuilderBookInterface;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateMessageAfterStoreBookContextEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        protected BuilderBookInterface $readBook,
        protected bool $success = true,
    ) {}

    /**
     * @return PrivateChannel[]
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('messages'),
        ];
    }
}
