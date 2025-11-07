<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase; // Reset database after each test

    public function test_user_can_login_with_correct_credentials()
    {
        // 1. Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password123',
            'role'=>'admin'
        ]);

        // 2. Make POST request to login route
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // 3. Check if user is redirected after login
        $response->assertRedirect('/dashboard'); // or your dashboard route

        // 4. Check if user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Check if login fails
        $response->assertSessionHasErrors();
        $this->assertGuest(); // User is not logged in
    }
}
