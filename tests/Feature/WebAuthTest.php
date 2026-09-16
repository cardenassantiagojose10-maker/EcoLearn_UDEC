<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_log_in_through_the_web_form_and_reach_the_dashboard(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_the_session_id_is_regenerated_after_login_to_prevent_session_fixation(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        // Prime a session before authenticating.
        $this->get('/login');
        $idBefore = session()->getId();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertNotEquals($idBefore, session()->getId());
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHas('error');
        $this->assertGuest();
    }
}
