<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return $tasks;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'text'    => 'required|min:1|max:255'
        ]);

        Task::create([
            'text' => $request->input('text')
        ]);
    }

    public function toggle(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
    }

    public function destroy(Task $task)
    {
        Task::destroy($task->id);
    }
}
