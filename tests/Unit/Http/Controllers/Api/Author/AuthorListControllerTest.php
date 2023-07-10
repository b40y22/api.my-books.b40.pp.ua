<?php

namespace Tests\Unit\Http\Controllers\Api\Author;

use App\Models\Author;
use App\Models\User;
use Tests\TestCase;

class AuthorListControllerTest extends TestCase
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

    public function testAuthorListValid(): void
    {
        $response = $this->getJson(route("author.list", [
            'perPage' => 3,
            'orderBy' => 'id,desc'
        ]), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);

        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertFields($content['data']['authors']);
    }

    /**
     * @return int[][]
     */
    public static function perPageProviderCase(): array
    {
        return [
            [0],
            [-1]
        ];
    }

    /**
     * @dataProvider perPageProviderCase
     */
    public function testAuthorListWithPerPageInvalid(int $perPage): void
    {
        $response = $this->getJson(route('author.list', [
            'perPage' => $perPage,
            'orderBy' => "desc"
        ]), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);

        $response->assertStatus(400);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
    }

    public function testAuthorListWithoutPerPage(): void
    {
        $response = $this->getJson(route('author.list', [
            'orderBy' => "id,desc"
        ]), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertFields($content['data']['authors']);
        $this->assertCount(6, $content['data']['authors']);
    }

    public function testAuthorListWithoutOrderBy(): void
    {
        $response = $this->getJson(route('author.list', [
            'perPage' => 1,
        ]), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertFields($content['data']['authors']);
        $this->assertCount(1, $content['data']);
    }

    public function testAuthorListWithCurrentPageInvalid(): void
    {
        $response = $this->getJson(route('author.list', [
            'perPage' => 1,
            'currentPage' => 100500
        ]), [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ]);
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertFields($content['data']['authors']);
        $this->assertCount(0, $content['data']['authors']['items']);
    }

    /**
     * @param array $authors
     */
    protected function assertFields(array $authors): void
    {
        $this->assertArrayHasKey('currentPage', $authors);
        $this->assertArrayHasKey('perPage', $authors);
        $this->assertArrayHasKey('total', $authors);
        $this->assertArrayHasKey('lastPage', $authors);
        $this->assertArrayHasKey('orderBy', $authors);
        $this->assertArrayHasKey('items', $authors);
        $this->assertIsArray($authors['items']);
    }
}
