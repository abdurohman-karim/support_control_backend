<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $yesterday = Carbon::now()->subDay();

        $tasks = Task::all()->groupBy('chat_name');

        $lastTasksCounts = [];
        foreach ($tasks as $chatName => $group) {
            $lastTasksCounts[$chatName] = $group->filter(function ($task) use ($yesterday) {
                return $task->created_at >= $yesterday && $task->is_done == 0 && $task->is_archived == 0;
            })->count();
        }

        return view('pages.task.index', compact('tasks', 'lastTasksCounts'));
    }

    public function show_chat($chat_id)
    {
        $tasks = Task::where('chat_id', $chat_id)
            ->where('is_archived', 0)
            ->orderBy('created_at', 'desc')->get();
        $chat_name = Task::where('chat_id', $chat_id)->first()->chat_name;
        return view('pages.task.group-tasks', compact('tasks', 'chat_name'));
    }

    public function to_done($id)
    {
        $task = Task::find($id);
        $task->is_done = 1;
        $task->done($task->chat_id, $task->message_id);
        $task->save();
        return response()->json(['success' => true]);
    }

    public function to_archived($id)
    {
        $task = Task::find($id);
        $task->is_archived = 1;
        $task->archived($task->chat_id, $task->message_id);
        $task->save();
        return response()->json(['success' => true]);
    }
}
