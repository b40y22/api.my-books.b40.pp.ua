<?php

namespace Unit\Http\Controllers\Api\Author;


use App\Models\Author;
use App\Models\User;
use Tests\TestCase;

class AuthorUpdateControllerTest extends TestCase
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

    public function testAuthorUpdateWithValidData(): void
    {
        $response = $this->postJson(route("author.update"), [
            'id' => $this->Author->id,
            'firstname' => $this->Author->firstname . 'Test',
            'lastname' => $this->Author->lastname . 'Test'
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);

        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $author = Author::find($this->Author->id);
        $this->assertNotNull($author);
        $this->assertEquals($this->Author->firstname . 'Test', $author->firstname);
        $this->assertEquals($this->Author->lastname . 'Test', $author->lastname);
    }

    public function testAuthorUpdateWithInvalidId()
    {
        $response = $this->postJson(route("author.update"), [
            'id' => 100500,
            'firstname' => $this->Author->firstname . 'Test',
            'lastname' => $this->Author->lastname . 'Test'
        ], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);

        $response->assertStatus(500);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('errors', $content);
    }
}
