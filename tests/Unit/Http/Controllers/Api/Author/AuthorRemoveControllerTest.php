<?php

namespace Unit\Http\Controllers\Api\Author;


use App\Models\Author;
use App\Models\User;
use Tests\TestCase;

class AuthorRemoveControllerTest extends TestCase
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

    public function testAuthorRemoveValid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->deleteJson(route('author.delete', ['id' => $this->Author->id]));

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $content);
        $this->assertArrayHasKey('id', $content['data']['author']);
        $this->assertArrayHasKey('firstname', $content['data']['author']);
        $this->assertArrayHasKey('lastname', $content['data']['author']);
    }

    public function testAuthorRemoveWithoutId(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->deleteJson(route('author.delete', ['id' => 0]));
        $response->assertStatus(500);
    }
}
