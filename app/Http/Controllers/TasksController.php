<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    function index()
    {
        $tasks = Task::all();

        return response($tasks, 200);
    }

    function store(Request $request)
    {
        $task = Task::create([
            "title" => $request->input("title")
        ]);

        return response($task, 201);
    }

    function deleteAllTasks()
    {
        info("it's gonna delete all the tasks");

        Task::truncate();

        info("now tasks should be deleted");

        return response()->json(["message" => "Tasks deleted successfully!!!"]);
    }

    function deleteOneTask($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
            return response()->json(["message" => "Task was successfully deleted!!!"]);
        } else {
            return response()->json(["message" => "Task couldn't be found"]);
        }
    }
}
