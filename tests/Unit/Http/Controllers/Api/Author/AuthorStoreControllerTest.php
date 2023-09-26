<?php

namespace Unit\Http\Controllers\Api\Author;

use App\Models\Author;
use App\Models\User;
use Tests\TestCase;

class AuthorStoreControllerTest extends TestCase
{
    /**
     * @var User
     */
    protected User $User;

    /**
     * @var Author
     */
    protected $Author;

    protected function setUp():void
    {
        parent::setUp();
        $this->User = User::factory()->create();
        $this->Author = Author::factory()->create([
            'user_id' => $this->User->id
        ]);
    }

    public function testAuthorStoreValid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->postJson(route('author.store'), [
                'firstname' => $this->Author->firstname,
                'lastname' => $this->Author->lastname
            ]);

        $response->assertStatus(201);
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($content['data']['author']['firstname'], $this->Author->firstname);
        $this->assertEquals($content['data']['author']['lastname'], $this->Author->lastname);
    }

    public function testAuthorStoreWithoutFirstname(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->postJson(route('author.store'), [
                'lastname' => $this->Author->lastname
            ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $content);
    }
}
