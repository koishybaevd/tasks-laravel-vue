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

    public function store()
    {
        Task::create([
            'text' => request('text')
        ]);
    }

    public function destroy(Task $task)
    {
        Task::destroy($task->id);
    }
}
