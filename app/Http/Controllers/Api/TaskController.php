<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:1000',
            'user_id' => 'required',
            'group_id' => 'required',
            'group_name' => 'required',
            'message_id' => 'required'
        ]);

        if ($validator->fails()) {
            return ['status' => 'error', 'message' => $validator->errors()];
        }

        $task = new Task();
        $task->text = $request->text;
        $task->user_id = $request->user_id;
        $task->chat_id = $request->group_id;
        $task->chat_name = $request->group_name;
        $task->message_id = $request->message_id;
        $task->save();
        return ['status' => 'success', 'task' => $task];
    }
}
