<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModelTest extends TestCase
{
    private function createUserWithTasks() {
        $user = User::factory()->create();

        $tasks = Task::factory(5)->create([
            'user_id' => $user->id,
        ]);

        return [
            'user' => $user,
            'tasks' => $tasks,
        ];
    }

    /** @test */
    public function users_tasks_have_correct_length() {
        $created = $this->createUserWithTasks();

        $user = $created['user'];
        $tasks = $created['tasks'];

        $modelsAreEqual = true;

        foreach ($user->tasks as $key => $task) {
            if (!$task->is($tasks[$key])) {
                $modelsAreEqual = false;
            }
        }

        $this->assertTrue($modelsAreEqual);
    }
}
