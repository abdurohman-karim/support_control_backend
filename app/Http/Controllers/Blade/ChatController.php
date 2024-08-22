<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::all();
        return view('pages.message.index', compact('chats'));
    }

    public function message(Request $request)
    {
        // Validate the request
        $request->validate([
            'chat_ids' => 'required|array',
            'chat_ids.*' => 'exists:chats,chat_id',
            'message' => 'required|string|max:4096',
        ]);

        // Retrieve chats
        $chats = Chat::whereIn('chat_id', $request->chat_ids)->get();

        // Track successes and failures
        $successCount = 0;
        $failureCount = 0;

        foreach ($chats as $chat) {
            if ($chat->sendTelegramMessage($request->message, $chat->chat_id)) {
                $successCount++;
            } else {
                $failureCount++;
            }
        }

        // Create feedback message
        $statusMessage = "{$successCount} message(s) sent successfully";
        if ($failureCount > 0) {
            $statusMessage .= " and {$failureCount} failed.";
        } else {
            $statusMessage .= ".";
        }

        // Redirect with success message
        message_set($statusMessage, 'success');
        return redirect()->back();
    }
}
