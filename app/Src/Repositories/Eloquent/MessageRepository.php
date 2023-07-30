<?php
declare(strict_types=1);

namespace App\Src\Repositories\Eloquent;

use App\Models\Message;
use App\Src\Repositories\Interfaces\MessageRepositoryInterface;

class MessageRepository extends AbstractRepository implements MessageRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Message::class);
    }

    /**
     * @param array $message
     * @return mixed
     */
    public function store(array $message): mixed
    {
        return $this->model::create($message);
    }
}
