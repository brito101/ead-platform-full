<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use UtilsTrait;

    public function test_fail_auth()
    {
        $response = $this->postJson('/api/auth', []);
        $response->assertStatus(422);
    }

    public function test_auth()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'test'
        ]);

        $response->assertStatus(200);
    }

    public function test_error_logout()
    {
        $response = $this->postJson('/api/logout');

        $response->assertStatus(401);
    }

    public function test_logout()
    {
        $token = $this->createTokenUser();

        $response = $this->postJson('/api/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }

    public function test_error_get_me()
    {
        $response = $this->getJson('/api/me');

        $response->assertStatus(401);
    }

    public function test_get_me()
    {
        $token = $this->createTokenUser();

        $response = $this->getJson('/api/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }
}
