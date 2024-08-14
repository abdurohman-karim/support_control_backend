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

        foreach ($tasks as $chatId => $group) {
            $group->first()->updateChatName();
        }

        $lastTasksCounts = [];
        foreach ($tasks as $chatName => $group) {
            $lastTasksCounts[$chatName] = $group->filter(function ($task) use ($yesterday) {
                return $task->created_at >= $yesterday && $task->is_done == 0 && $task->is_archived == 0 && $task->is_deleted == 0;
            })->count();
        }

        return view('pages.task.index', compact('tasks', 'lastTasksCounts'));
    }

    public function show_chat($chat_id)
    {
        $tasks = Task::where('chat_id', $chat_id)
            ->where('is_archived', 0)
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'desc')->paginate(10);
        $chat_name = Task::where('chat_id', $chat_id)->first()->chat_name;
        return view('pages.task.group-tasks', compact('tasks', 'chat_name'));
    }

    public function show_archives($chat_id)
    {
        $tasks = Task::where('chat_id', $chat_id)
            ->where('is_archived', 1)
            ->orderBy('created_at', 'desc')->paginate(10);
        $chat_name = Task::where('chat_id', $chat_id)->first()->chat_name;
        return view('pages.task.archive', compact('tasks', 'chat_name'));
    }

    public function to_done($id)
    {
        $task = Task::findOrFail($id);
        if ($task->is_done == 1) {
            return response()->json(['success' => false]);
        }
        $task->is_done = 1;
        $task->done($task->chat_id, $task->message_id);
        $task->save();
        return response()->json(['success' => true]);
    }

    public function to_archived($id)
    {
        $task = Task::findOrFail($id);
        if ($task->is_done == 1) {
            return response()->json(['success' => false]);
        }
        $task->is_archived = 1;
        $task->archived($task->chat_id, $task->message_id);
        $task->save();
        return response()->json(['success' => true]);
    }

    public function unzip($id)
    {
        $task  = Task::find($id);
        $task->is_archived = 0;
        $task->unzip($task->chat_id, $task->message_id);
        $task->save();
        return response()->json(['success' => true]);
    }

    public function to_delete($id)
    {
        $task = Task::findOrFail($id);
        $task->is_deleted = 1;
        $task->save();
        return response()->json(['success' => true]);
    }
}
