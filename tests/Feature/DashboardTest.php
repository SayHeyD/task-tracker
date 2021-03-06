<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function dashboard_returns_200_when_authenticated()
    {
        $user = User::factory()->create();

        Auth::login($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function dashboard_returns_to_login_when_unauthenticated() {

        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }
}
