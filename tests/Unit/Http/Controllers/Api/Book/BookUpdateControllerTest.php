<?php

namespace Unit\Http\Controllers\Api\Book;


use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class BookUpdateControllerTest extends TestCase
{
    /**
     * @var User
     */
    protected User $User;

    /**
     * @var Book
     */
    protected Book $Book;

    /**
     * @var Author
     */
    protected Author $Author;

    protected function setUp():void
    {
        parent::setUp();
        $this->User = User::factory()->create();
        $this->Book = Book::factory()->create([
            'user_id' => $this->User->id
        ]);
        $this->Author = Author::factory()->create([
            'user_id' => $this->User->id
        ]);
    }

    public function testBookUpdateWithValidData(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->putJson(route("book.update", ['id' => $this->Book->id]), [
                'title' => $this->Book->title . 'Test',
            ]);

        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $book = Book::find($this->Book->id);
        $this->assertNotNull($book);
        $this->assertEquals($this->Book->title . 'Test', $book->title);
    }

    public function testBookUpdateWithInvalidId()
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->putJson(route("book.update", ['id' => 100500]), [
                'title' => $this->Book->title . 'Test'
            ]);

        $response->assertStatus(404);

        $message = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $message);
    }
}
