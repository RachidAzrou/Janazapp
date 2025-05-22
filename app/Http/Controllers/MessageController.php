<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(Message::getValidationRules());

        $message = Message::create([
            'case_id' => $request->case_id,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message_type' => $request->message_type,
            'content' => $request->content,
            'metadata' => $request->metadata,
            'status' => $request->status,
            'read_at' => $request->read_at,
            'delivered_at' => $request->delivered_at,
        ]);

        return response()->json($message, 201);
    }
}

