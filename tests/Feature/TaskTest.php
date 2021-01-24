<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    private function authenticateUser() {

        $user = User::factory()->create();

        Auth::login($user);

        return $user;
    }

    private function sendValidTaskStoreRequest($title = 'Repair dishwasher') {

        return $this->put('/tasks', [
            'title' => $title,
            'description' => 'Repair my dishwasher since my cat broke it.',
            'due_at' => Carbon::now()->addDays(12)->toDateTimeString(),
        ]);
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

        User::factory()->create();
        $task = Task::factory()->create();

        $response = $this->get('/tasks/'.$task->id);

        $response->assertRedirect('/login');

    }

    /** @test */
    public function tasks_update_returns_redirect_back_when_authenticated_and_update_data_is_correct() {

        $this->authenticateUser();

        $task = Task::factory()->create();

        $response = $this->from('/tasks')->patch('/tasks/'.$task->id, [
            'title' => 'Do dishes',
            'description' => 'Clean dishes of my neighbour',
            'status' => 'completed',
            'due_at' => Carbon::now()->toDateTimeString(),
        ]);

        $response->assertRedirect('/tasks');
    }

    /** @test */
    public function tasks_update_returns_with_title_error_when_authenticated_and_title_too_long() {

        $this->authenticateUser();

        $task = Task::factory()->create();

        $response = $this->from('/tasks')->patch('/tasks/'.$task->id, [
            'title' => 'This is a text that is longer then two hundred fifty characters so that a error should be triggered. This is a text that is longer then two hundred fifty characters so that a error should be triggered. This is a text that is longer then two hundred fifty characters so that a error should be triggered. This is a text that is longer then two hundred fifty characters so that a error should be triggered. This is a text that is longer then two hundred fifty characters so that a error should be triggered. This is a text that is longer then two hundred fifty characters so that a error should be triggered. This is a text that is longer then two hundred fifty characters so that a error should be triggered.'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test  */
    public function tasks_update_returns_with_due_at_error_when_authenticated_and_due_at_not_formatted_correctly() {

        $this->authenticateUser();

        $task = Task::factory()->create();

        $response = $this->from('/tasks')->patch('/tasks/'.$task->id, [
            'due_at' => '15.01.2021 15:45:12'
        ]);

        $response->assertSessionHasErrors('due_at');
    }

    /** @test */
    public function tasks_update_returns_to_index_page_when_request_is_valid_and_comes_from_edit_page() {
        $this->authenticateUser();

        $task = Task::factory()->create();

        $response = $this->from('tasks/'.$task->id)->patch('tasks/'.$task->id, [
            'status' => 'open'
        ]);

        $response->assertRedirect('/tasks');
    }

    /** @test */
    public function tasks_create_page_returns_200_when_authenticated() {

        $this->authenticateUser();

        $response = $this->get('tasks/new');

        $response->assertStatus(200);
    }

    /** @test */
    public function tasks_create_page_returns_redirect_to_login_when_unauthenticated() {

        $response = $this->get('tasks/new');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function tasks_store_returns_to_tasks_index_when_successful() {

        $this->authenticateUser();

        $this->sendValidTaskStoreRequest()->assertRedirect('/tasks');
    }

    /** @test */
    public function tasks_store_has_success_message_when_request_is_successful() {

        $this->authenticateUser();

        $title = 'Some Title';

        $this->sendValidTaskStoreRequest($title)->assertSessionHas('success', 'The Task "'.$title.'" was successfully created!');
    }

    /** @test */
    public function tasks_store_returns_to_login_when_unauthenticated() {
        $this->sendValidTaskStoreRequest()->assertRedirect('login');
    }
}
