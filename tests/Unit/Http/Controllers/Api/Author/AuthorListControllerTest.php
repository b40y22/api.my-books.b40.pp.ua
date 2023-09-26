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

    /**
     * @return void
     */
    public function testAuthorListValid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)->getJson(route("author.list", [
            'perPage' => 3,
            'orderBy' => 'id,desc'
        ]));

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
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route('author.list', [
                'perPage' => $perPage,
                'orderBy' => "desc"
            ]));

        $response->assertStatus(400);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
    }

    /**
     * @return void
     */
    public function testAuthorListWithoutPerPage(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route('author.list', [
                'orderBy' => "id,desc"
            ]));
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertFields($content['data']['authors']);
        $this->assertCount(6, $content['data']['authors']);
    }

    /**
     * @return void
     */
    public function testAuthorListWithoutOrderBy(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route('author.list', [
                'perPage' => 1,
            ]));
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);

        $this->assertFields($content['data']['authors']);
        $this->assertCount(1, $content['data']);
    }

    /**
     * @return void
     */
    public function testAuthorListWithCurrentPageInvalid(): void
    {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->User->createToken('Token')->plainTextToken
        ];
        $response = $this->withHeaders($headers)
            ->getJson(route('author.list', [
                'perPage' => 1,
                'currentPage' => 100500
            ]));
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
