<?php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Show list of chats
    public function index()
    {
        $user = Auth::user();

        $messages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->unique(function ($msg) use ($user) {
                return $msg->sender_id === $user->id ? $msg->receiver_id : $msg->sender_id;
            });

        return view('pages.messages.index', compact('messages', 'user'));
    }

    public function create()
{
    $users = User::where('id', '!=', auth()->id())->get(); // all other users
    return view('pages.messages.create', compact('users'));
}


    // Show single chat
public function show($id)
{
    $receiver = User::findOrFail($id);

    $messages = Message::where(function ($q) use ($id) {
        $q->where('sender_id', auth()->id())
          ->where('receiver_id', $id);
    })->orWhere(function ($q) use ($id) {
        $q->where('sender_id', $id)
          ->where('receiver_id', auth()->id());
    })
    ->orderBy('created_at', 'asc')
    ->get();

    return view('messages.show', compact('messages', 'receiver'));
}

    // Send message


public function store(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string|max:5000',
    ]);

    $message = Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return response()->json(['message' => $message->message]);
}

public function markAsRead(Message $message)
{
    // Ensure the current user is the receiver of the message
    if ($message->receiver_id !== auth()->id()) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    // Mark the message as read
    $message->update(['is_read' => true]);

    return response()->json(['success' => true]);
}
public function send(Request $request)
{
    $message = Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
        'is_read' => false,
    ]);

    broadcast(new \App\Events\MessageSent($message))->toOthers();

    return response()->json(['message' => $message]);
}


}
