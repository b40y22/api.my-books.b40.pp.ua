<?php

namespace Unit\Http\Controllers\Api\Book;


use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class BookGetControllerTest extends TestCase
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

    public function testBookGetValid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route("book.get", [
                'id' => $this->Book->id,
            ]));
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $content);
        $this->assertArrayHasKey('errors', $content);
        $this->assertArrayHasKey('book', $content['data']);
        $this->assertArrayHasKey('id', $content['data']['book']);
        $this->assertArrayHasKey('title', $content['data']['book']);
        $this->assertCount(2, $content);
    }

    public function testBookGetWithIdInvalid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route("book.get", ['id' => 100500]));

        $response->assertStatus(404);
    }
}
