<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // Create a user
    public function test_login_redirects_to_dashboard_successfully(){
    // User::factory()->create([
    //     'email' => 'chris@gmail.com',
    //     'password' => bcrypt('11111111')
    // ]);

    // Attempt to log in the user
    $response = $this->post('/login', [
        'email' => 'chris@gmail.com',
        'password' => '11111111'
    ]);

    // Assert that the response is a redirect
    $response->assertStatus(302);

    // Assert that the response redirects to the dashboard
    $response->assertRedirect('/dashboard');
}

public function test_auth_user_can_access_dashboard()
{
    // Create a user
    $user = User::factory()->create();

    // Authenticate the user
    $this->actingAs($user);

    // Access the dashboard
    $response = $this->get('/dashboard');

    // Assert that the response is successful (status 200)
    $response->assertStatus(200);
}

public function test_unauth_user_cannot_access_dashboard()
{
    // Attempt to access the dashboard without authentication
    $response = $this->get('/dashboard');

    // Assert that the response is a redirect (status 302)
    $response->assertStatus(302);

    // Assert that the response redirects to the login page
    $response->assertRedirect('/login');
}

}
