<?php

namespace Unit\Http\Controllers\Api\Author;


use App\Models\Author;
use App\Models\User;
use Tests\TestCase;

class AuthorGetControllerTest extends TestCase
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

    public function testAuthorGetValid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route("author.get", [
                'id' => $this->Author->id,
            ]));

        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('id', $content['data']['author']);
        $this->assertArrayHasKey('firstname', $content['data']['author']);
        $this->assertArrayHasKey('lastname', $content['data']['author']);
        $this->assertCount(2, $content);
        $this->assertCount(5, $content['data']['author']);
    }

    public function testAuthorGetWithIdInvalid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route("author.get", [
                'id' => 100500,
            ]));

        $response->assertStatus(404);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }
}
