<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Show inbox
    public function index()
    {
        $user = Auth::user();
        $messages = Message::where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        return view('messages.index', compact('messages', 'user'));
    }

    // Show conversation with specific user
    public function show($id)
    {
        $user = Auth::user();
        $receiver = User::findOrFail($id);

        $messages = Message::where(function ($query) use ($user, $receiver) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', $receiver->id);
            })
            ->orWhere(function ($query) use ($user, $receiver) {
                $query->where('sender_id', $receiver->id)
                      ->where('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read
        Message::where('receiver_id', $user->id)
            ->where('sender_id', $receiver->id)
            ->update(['is_read' => true]);

        return view('messages.show', compact('messages', 'receiver'));
    }

    // Send message
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:5000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent successfully.');
    }
}
