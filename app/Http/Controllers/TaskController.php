<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TaskController extends Controller
{

    public function index() {

        return Inertia::render('Task/Index', [
            'Tasks' => Task::where('user_id', Auth::user()->id)->paginate(),
        ]);

    }

    public function edit() {

    }

    public function delete() {

    }

    public function create() {

    }

    public function update(UpdateTaskRequest $request, Task $task) {

        if (!$request->complete) {
            $request->complete = false;
        }

        $task->fill([
            'title' => $request->title,
            'description' => $request->description,
            'complete' => $request->complete,
            'due_at' => $request->due_at,
            'user_id' => $request->user_id,
        ]);

        $task->save();

        return redirect()->back()->with('success', 'Task successfully updated.');
    }
}
