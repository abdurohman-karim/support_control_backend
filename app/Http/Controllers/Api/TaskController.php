<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Chat;

use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:1000',
            'user_id' => 'required',
            'group_id' => 'required',
            'group_name' => 'required|string|max:255',
            'message_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $task = Task::create([
            'text' => $request->input('text'),
            'user_id' => $request->input('user_id'),
            'chat_id' => $request->input('group_id'),
            'chat_name' => $request->input('group_name'),
            'message_id' => $request->input('message_id'),
        ]);

        $chat = Chat::firstOrNew(['chat_id' => $request->input('group_id')]);
        if ($chat->exists) {
            if ($chat->name !== $request->input('group_name')) {
                $chat->name = $request->input('group_name');
                $chat->save();
            }
        } else {
            $chat->name = $request->input('group_name');
            $chat->save();
        }

        return response()->json([
            'status' => 'success',
            'task' => $task
        ], 201);
    }
}
