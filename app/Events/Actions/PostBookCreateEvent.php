<?php
declare(strict_types=1);

namespace App\Events\Actions;

use App\Events\Interfaces\BookEventInterface;
use App\Models\Book;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostBookCreateEvent implements BookEventInterface
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Book $Book
     * @param bool $success
     */
    public function __construct(
        protected Book $Book,
        protected bool $success = true,
    ) {}

    /**
     * @return array
     */
    public function getMessageArray(): array
    {
        $book = $this->Book->toArray();

        $result = [
            'id' => $book['id'],
            'title' => $book['title'],
            'pages' => $book['pages'],
            'year' => $book['year'],
        ];

        foreach ($book['authors'] as $item) {
            $result['authors'][] = [
                'id' => $item['id'],
                'firstname' => $item['firstname'],
                'lastname' => $item['lastname'],
            ];
        }

        return $result;
    }
}
