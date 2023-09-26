<?php

namespace Unit\Http\Controllers\Api\Auth;


use App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function testLoginWithValidData()
    {
        $user = User::factory()->create();
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.login'), [
            'email' => $user->email,
            'password' => "password",
        ]);

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('token', $content['data']);
    }

    public function testLoginWithoutEmail()
    {
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.login'), [
            'password' => "password",
        ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }

    public function testLoginWithoutPassword()
    {
        $user = User::factory()->create();
        $headers = ['Accept' => 'application/json'];

        $response = $this->withHeaders($headers)->post(route('auth.login'), [
            'email' => $user->email
        ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }
}
