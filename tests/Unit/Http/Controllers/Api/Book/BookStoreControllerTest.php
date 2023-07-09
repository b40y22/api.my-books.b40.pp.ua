<?php

namespace Unit\Http\Controllers\Api\Book;


use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class BookStoreControllerTest extends TestCase
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

    /**
     * @return void
     */
    public function testBookStoreWithMaximalData(): void
    {
        $data = [
            'authors' => [
                [
                    'id' => 0,
                    'new' => true,
                    'firstname' => $this->Author->firstname,
                    'lastname' => $this->Author->lastname,
                ],
                [
                    'id' => 0,
                    'new' => true,
                    'firstname' => $this->Author->firstname,
                    'lastname' => $this->Author->lastname,
                ],
            ],
            'description' => $this->Book->description,
            'title' => $this->Book->title,
            'pages' => $this->Book->pages,
            'year' => $this->Book->year,
        ];

        $response = $this->postJson(route('book.store'), $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);

        $response->assertStatus(201);

        $content = json_decode($response->getContent(), true);

        $this->assertEquals($content['data']['book']['title'], $this->Book->title);
    }

    /**
     * @return void
     */
    public function testBookStoreWithMinimalData(): void
    {
        $data = [
            'authors' => [
                [
                    'id' => 0,
                    'new' => true,
                    'firstname' => $this->Author->firstname,
                    'lastname' => $this->Author->lastname,
                ],
            ],
            'title' => $this->Book->title,
        ];

        $response = $this->postJson(route('book.store'), $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);
        $response->assertStatus(201);
    }

    /**
     * @param array $content
     * @return void
     */
    protected function checkResponseArrayStructure(array $content): void
    {
        $this->assertArrayHasKey('id', $content['data']['book']);
        $this->assertArrayHasKey('title', $content['data']['book']);
    }
}
