<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    private function authenticateUser() {

        $user = User::factory()->create();

        Auth::login($user);
    }

    /** @test */
    public function tasks_index_returns_200_when_authenticated() {

        $this->authenticateUser();

        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }

    /** @test */
    public function tasks_index_returns_to_login_when_authenticated() {

        $response = $this->get('/tasks');

        $response->assertRedirect('/login');

    }
}
