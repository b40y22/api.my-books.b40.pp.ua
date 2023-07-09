<?php
declare(strict_types=1);

namespace App\Src\Services\Book;

use App\Models\Book;

abstract class AbstractBookService
{
    /**
     * @param array $authors
     * @param Book $Book
     * @return array
     */
    public function formatAuthorsArray(array $authors, Book $Book): array
    {
        $authorsArray = [];

        foreach ($authors as $Author) {
            $SavedAuthor = $this->authorRepository->createIfNotExist($Author);
            $Book->authors()->attach($SavedAuthor['id']);

            $Author = $SavedAuthor->toArray();
            ksort($Author);

            $authorsArray[] = $Author;
        }

        return $authorsArray;
    }
}
