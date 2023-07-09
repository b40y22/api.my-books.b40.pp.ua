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
    protected $Book;

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
        $response = $this->postJson(route("book.update"), [
            'authors' => [
                [
                    'id' => $this->Author->id,
                    'new' => false,
                    'firstname' => $this->Author->firstname,
                    'lastname' => $this->Author->lastname,
                ],
            ],
            'id' => $this->Book->id,
            'title' => $this->Book->title . 'Test',
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
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
        $response = $this->postJson(route("book.update"), [
            'authors' => [
                [
                    'id' => $this->Author->id,
                    'new' => false,
                    'firstname' => $this->Author->firstname,
                    'lastname' => $this->Author->lastname,
                ],
            ],
            'id' => 100500,
            'title' => $this->Book->title . 'Test'
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);

        $response->assertStatus(404);

        $message = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $message);
    }
}