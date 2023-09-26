<?php

namespace Unit\Http\Controllers\Api\Book;


use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class BookRemoveControllerTest extends TestCase
{
    /**
     * @var User
     */
    protected User $User;

    /**
     * @var Book
     */
    protected $Book;

    protected function setUp():void
    {
        parent::setUp();
        $this->User = User::factory()->create();
        $this->Book = Book::factory()->create([
            'user_id' => $this->User->id
        ]);
    }

    public function testBookRemoveValid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->deleteJson(route('book.delete', ['id' => $this->Book->id]));

        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
    }

    public function testBookRemoveDoNotExistId(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->deleteJson(route('book.delete', ['id' => 100500]), []);
        $response->assertStatus(500);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $content);
    }

    public function testBookRemoveWithZeroId(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->deleteJson(route('book.delete', ['id' => 0]));
        $response->assertStatus(500);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $content);
    }
}
