<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = new ChatMessage([
            'user_id' => $user->id,
            'channel_id' => $request->channel_id,
            'message' => $request->message,
        ]);

        $message->save();

        event(new ChatMessageSent([
            'id' => $message->id,
            'user_id' => $user->id,
            'channel_id' => $request->channel_id,
            'message' => $message->message,
            'created_at' => $message->created_at->toIso8601String(),
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully.',
        ]);
    }

    public function getMessages($channelId)
    {
        $messages = ChatMessage::where('channel_id', $channelId)->get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages,
        ]);
    }
}
