<?php

namespace Unit\Http\Controllers\Api\Author;


use App\Models\Author;
use App\Models\User;
use Tests\TestCase;

class AuthorRemoveControllerTest extends TestCase
{
    /**
     * @var string
     */
    protected string $token;

    /**
     * @var Author
     */
    protected $author;

    protected function setUp():void
    {
        parent::setUp();
        $this->token = User::factory()->create()->createToken('client')->accessToken;
        $this->author = Author::factory()->create();
    }

    public function testAuthorRemoveValid(): void
    {
        $response = $this->postJson(route('author.remove'), [
            'id' => $this->author->id,
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ]);

        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $content);
        $this->assertArrayHasKey('id', $content['data']['author']);
        $this->assertArrayHasKey('firstname', $content['data']['author']);
        $this->assertArrayHasKey('lastname', $content['data']['author']);
    }

    public function testAuthorRemoveWithoutId(): void
    {
        $response = $this->postJson(route('author.remove'), [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(422);
    }

    public function testAuthorRemoveWithEmptyId(): void
    {
        $response = $this->postJson(route('author.remove'), [
            'id' => '',
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(422);
    }
}
