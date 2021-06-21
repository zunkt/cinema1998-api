<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $baseUrl = 'http://127.0.0.1:8000/';
    protected $headers = null;
    protected $user = null;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = $this->faker = Admin::factory()
            ->create([
                'name' => 'admin',
                'email' => 'tiendang212@gmail.com',
                'password' => Hash::make('Adminb123#'),
            ]);
    }

    /**
     * Test login success
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $this->user = $this->faker = Admin::factory()
            ->create([
                'name' => 'admin',
                'email' => 'tiendang212@gmail.com',
                'password' => Hash::make('Adminb123#'),
            ]);

        $response = $this->postJson( 'http://127.0.0.1:8000/api/admin/auth/login', ['email' => 'tiendang212@gmail.com', 'password' => 'Adminb123#']);
        $status = $response['code'];
        if ($response->assertStatus(JsonResponse::HTTP_OK))
            $response->assertJsonStructure(
                    ['success', 'data' => ['access_token', 'token_type', 'expires_at']]);
    }
}