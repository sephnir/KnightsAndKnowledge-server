<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Response;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login
     *
     * @return void
     */
    public function testLogin()
    {
        $this->seed();
        $user = User::first();
        Passport::actingAs($user);

        $response = $this->post('/oauth/token', [
            'username' => $user->email,
            'password' => 'password',
            'client_secret' => 'TzzipodhcJHdkv8bhIC37st3z9MBKn94MRRtw1Tw',
            'client_id' => 1,
            'grant_type' => 'password'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['token_type', 'expires_in', 'access_token', "refresh_token"]);
    }

    /**
     * Test invalid login.
     */
    public function testLoginWrongCred()
    {
        $this->seed();
        $response = $this->post('/api/login', [
            'username' => "invalidEmail@example.com",
            'password' => 'password'
        ]);

        $response
            ->assertStatus(401);
    }

    /**
     * Test Bearer Authentication
     *
     * @return void
     */
    public function testAuthToken()
    {
        $this->seed();
        $user = User::first();
        Passport::actingAs($user);

        $response = $this
            ->actingAs($user)
            ->post('/api/details');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['success']);
    }

    /**
     * Test invalid Bearer Authentication
     *
     * @return void
     */
    public function testInvalidAuthToken()
    {
        $this->seed();
        $bearer = "invalid-token";

        $response = $this->post('/api/details', [], [
            'Authorization' => 'Bearer ' . $bearer
        ]);

        $response
            ->assertStatus(401)
            ->assertJson(['error' => 'Session expired']);
    }
}
