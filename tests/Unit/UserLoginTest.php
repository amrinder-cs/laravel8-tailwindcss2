<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanLogin()
    {
        // Create a user
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Simulate a login request
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Check if login was successful
        $response->assertStatus(302); // Redirect status
        $this->assertTrue(Auth::check()); // User should be authenticated
    }
}
