<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_home_view_for_authenticated_users()
    {
        // Arrange
        $user = \App\Models\User::factory()->create(); // Create a test user

        // Act
        $response = $this->actingAs($user)->get('/home'); // Simulate authenticated request

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('home'); // Check if the view is 'home'
    }

    /** @test */
    public function it_redirects_unauthenticated_users()
    {
        // Act
        $response = $this->get('/home'); // Simulate unauthenticated request

        // Assert
        $response->assertStatus(302); // Expect a redirect
        $response->assertRedirect('/login'); // Check if redirected to login
    }
}
