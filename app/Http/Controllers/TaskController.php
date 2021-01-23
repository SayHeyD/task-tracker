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

    public function delete(Request $request, Task $task) {

        $task->delete();

        return redirect()->back()->with('success', 'The Task "'.$task->title.'" was successfully deleted.');
    }

    public function create() {
        return Inertia::render('Task/Create');
    }

    public function store() {

    }

    public function update(UpdateTaskRequest $request, Task $task) {

        if ($request->title) {
            $task->title = $request->title;
        }

        if ($request->description) {
            $task->description = $request->description;
        }

        if ($request->complete) {
            $task->complete = true;
        }
        else {
            $task->complete = false;
        }

        if ($request->due_at) {
            $task->due_at = $request->due_at;
        }

        $task->save();

        return redirect()->back()->with('success', 'Successfully updated "'.$task->title.'".');
    }
}
