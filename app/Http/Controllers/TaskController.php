<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class TaskController extends Controller
{

    public function index() {

        return Inertia::render('Task/Index', [
            'Filters' => Request::all('search'),
            'Tasks' => Task::where('user_id', Auth::id())
                ->where('title', 'LIKE', '%'.Request::input('search').'%')
                ->paginate(7),
        ]);
    }

    public function edit(Request $request, Task $task) {
        return Inertia::render('Task/Edit', [
            'task' => $task
        ]);
    }

    public function delete(Request $request, Task $task) {

        $task->delete();

        return redirect()->back()->with('success', 'The Task "'.$task->title.'" was successfully deleted.');
    }

    public function create() {
        return Inertia::render('Task/Create');
    }

    public function store(StoreTaskRequest $request) {
        $task = new Task();

        if (!$request->status) {
            $request->status = 'open';
        }

        $task->fill([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_at' => $request->due_at,
            'user_id' => Auth::id(),
        ]);

        $task->save();

        return redirect()->to(route('tasks.index'))->with('success', 'The Task "'.$task->title.'" was successfully created!');
    }

    public function update(UpdateTaskRequest $request, Task $task) {

        if ($request->title) {
            $task->title = $request->title;
        }

        if ($request->description) {
            $task->description = $request->description;
        }

        if ($request->status) {
            $task->status = $request->status;
        }

        if ($request->due_at) {
            $task->due_at = $request->due_at;
        }

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Successfully updated "'.$task->title.'".');
    }
}
