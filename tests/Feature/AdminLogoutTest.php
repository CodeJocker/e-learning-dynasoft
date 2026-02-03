<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;

class AdminLogoutTest extends TestCase
{
    use DatabaseMigrations;

    public function test_admin_can_logout_successfully()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Log in the admin
        $this->actingAs($admin);

        // Make a POST request to logout
        $response = $this->post('/admin/logout');

        // Assert redirect to login page
        $response->assertRedirect('/admin/login');

        // Assert user is logged out (session cleared)
        $this->assertGuest();
    }

    public function test_logout_destroys_session()
    {
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Log in the admin
        $this->actingAs($admin);

        // Access a protected route to confirm login
        $this->get('/admin/dashboard')->assertStatus(200);

        // Logout
        $this->post('/admin/logout');

        // Try to access protected route again, should redirect to login
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
    }
}
