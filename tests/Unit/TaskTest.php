<?php

namespace Tests\Unit;

use App\Models\Task;
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
    public function tasks_index_returns_to_login_when_unauthenticated() {

        $response = $this->get('/tasks');

        $response->assertRedirect('/login');

    }

    /** @test */
    public function tasks_edit_returns_200_when_authenticated() {

        $this->authenticateUser();

        $task = Task::factory()->create();

        $response = $this->get('/tasks/'.$task->id);

        $response->assertStatus(200);

    }

    /** @test */
    public function tasks_edit_returns_to_login_when_unauthenticated() {

        $task = Task::factory()->create();

        $response = $this->get('/tasks/'.$task->id);

        $response->assertRedirect('/login');

    }
}
