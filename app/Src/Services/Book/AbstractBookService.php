<?php

namespace App\Src\Services\Book;

use App\Models\Book;

abstract class AbstractBookService
{
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
