<?php

namespace Unit\Http\Controllers\Api\Auth;

use App\Models\User;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
    public function testRegisterWithValidData(): void
    {
        $user = User::factory()->make();
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ]);

        $response->assertStatus(201);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('token', $content['data']);
    }

    public function testRegisterWithInvalidPasswordConfirmation()
    {
        $user = User::factory()->make();
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password . '!'
        ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }

    public function testRegisterWithEmptyPasswordConfirmation()
    {
        $user = User::factory()->make();
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => ''
        ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }

    public function testRegisterWithEmptyPassword()
    {
        $user = User::factory()->make();
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => $user->password
        ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }

    public function testRegisterWithoutEmail()
    {
        $user = User::factory()->make();
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.register'), [
            'name' => $user->name,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }

    public function testRegisterWithoutName()
    {
        $user = User::factory()->make();
        $headers = ['Accept' => 'application/json'];
        $response = $this->withHeaders($headers)->post(route('auth.register'), [
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password
        ]);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $content);
        $this->assertCount(1, $content['errors']);
    }
}
