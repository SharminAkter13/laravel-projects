<?php
namespace App\Http\Controllers;

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
            ->orderBy('created_at')
            ->get();

        Message::where('receiver_id', $user->id)
            ->where('sender_id', $receiver->id)
            ->update(['is_read' => true]);

        return view('pages.messages.show', compact('messages', 'receiver'));
    }

    // Send message
public function store(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string|max:5000',
    ]);

    Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    return redirect()->route('messages.index')->with('success', 'Message sent!');
}
}
