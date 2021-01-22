<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
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

    public function update() {

    }
}
