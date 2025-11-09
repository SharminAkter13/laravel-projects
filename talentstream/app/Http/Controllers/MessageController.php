<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.messages.index');
    }

    /**
     * Fetch chat contacts based on user role
     */
public function getContacts()
{
    $user = Auth::user();

    $contacts = User::where('id', '!=', $user->id)
        ->when($user->role_id == 2, fn($q) => $q->where('role_id', 3)) // Candidate sees Employer
        ->when($user->role_id == 3, fn($q) => $q->where('role_id', 2)) // Employer sees Candidate
        ->select('id', 'name', 'role_id')
        ->get();

    // Add unread messages count for each contact
    foreach ($contacts as $contact) {
        $conversation = Conversation::where(function ($q) use ($user, $contact) {
            $q->where('user_one', $user->id)->where('user_two', $contact->id);
        })->orWhere(function ($q) use ($user, $contact) {
            $q->where('user_one', $contact->id)->where('user_two', $user->id);
        })->first();

        $contact->unread_count = 0;

        if ($conversation) {
            $contact->unread_count = Message::where('conversation_id', $conversation->id)
                ->where('sender_id', '!=', $user->id)
                ->where('is_read', false)
                ->count();
        }
    }

    return response()->json($contacts);
}

    /**
     * Retrieve all messages for a conversation between two users
     */
    public function getMessages($otherUserId)
    {
        $currentUserId = Auth::id();

        // Find existing conversation between two users
        $conversation = Conversation::where(function ($q) use ($currentUserId, $otherUserId) {
                $q->where('user_one', $currentUserId)
                  ->where('user_two', $otherUserId);
            })
            ->orWhere(function ($q) use ($currentUserId, $otherUserId) {
                $q->where('user_one', $otherUserId)
                  ->where('user_two', $currentUserId);
            })
            ->first();

        $messages = [];
        $conversationId = null;

        if ($conversation) {
            $conversationId = $conversation->id;
            $messages = $conversation->messages()
                ->with('sender:id,name')
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return response()->json([
            'conversation_id' => $conversationId,
            'messages' => $messages,
        ]);
    }

    /**
     * Send a new message and create a conversation if needed
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'text' => 'required|string|max:1000',
        ]);

        $currentUserId = Auth::id();
        $receiverId = $request->receiver_id;
        $text = $request->text;

        // Find or create conversation
        $conversation = Conversation::where(function ($q) use ($currentUserId, $receiverId) {
                $q->where('user_one', $currentUserId)
                  ->where('user_two', $receiverId);
            })
            ->orWhere(function ($q) use ($currentUserId, $receiverId) {
                $q->where('user_one', $receiverId)
                  ->where('user_two', $currentUserId);
            })
            ->first();

        if (!$conversation) {
            $ids = [$currentUserId, $receiverId];
            sort($ids); // Ensure consistent order
            $conversation = Conversation::create([
                'user_one' => $ids[0],
                'user_two' => $ids[1],
            ]);
        }

        // Create and store message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $currentUserId,
            'message' => $text,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $message->load('sender:id,name'),
        ]);
    }

    public function markAsRead(Conversation $conversation)
{
    Message::where('conversation_id', $conversation->id)
        ->where('sender_id', '!=', Auth::id())
        ->update(['is_read' => true]);

    return response()->json(['status' => 'success']);
}
}
