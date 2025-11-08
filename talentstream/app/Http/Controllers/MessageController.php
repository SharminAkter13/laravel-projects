<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Show the main chat interface view.
     */
    public function index()
    {
        // This will load the Blade file where the JavaScript resides.
        return view('chat');
    }

    /**
     * Get a list of users (contacts) to chat with.
     * Assuming 'role' is a field on the User model.
     */
    public function getContacts()
    {
        $user = Auth::user();

        // Determine the target role (Employer chats with Candidate, and vice-versa)
        $targetRole = ($user->role === 'Candidate') ? 'Employer' : 'Candidate';

        // Fetch contacts who have the target role, excluding the current user.
        $contacts = User::where('role', $targetRole)
            ->where('id', '!=', $user->id)
            ->select('id', 'name', 'role') // Only select necessary fields
            ->get();

        return response()->json($contacts);
    }

    /**
     * Get messages for a specific conversation ID (or create conversation if needed).
     */
    public function getMessages($otherUserId)
    {
        $currentUserId = Auth::id();

        // Find existing conversation (user_one, user_two or user_two, user_one)
        $conversation = Conversation::where(function ($q) use ($currentUserId, $otherUserId) {
                $q->where('user_one', $currentUserId)->where('user_two', $otherUserId);
            })
            ->orWhere(function ($q) use ($currentUserId, $otherUserId) {
                $q->where('user_one', $otherUserId)->where('user_two', $currentUserId);
            })
            ->first();

        $messages = [];
        $conversationId = null;

        if ($conversation) {
            $conversationId = $conversation->id;
            // Eager load sender relationship
            $messages = $conversation->messages()
                ->with('sender:id,name')
                ->latest() // Get newest messages last
                ->get()
                ->sortBy('created_at')
                ->values(); // Re-index keys
        }

        return response()->json([
            'conversation_id' => $conversationId,
            'messages' => $messages,
        ]);
    }

    /**
     * Send a new message.
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

        // 1. Find or Create Conversation
        $conversation = Conversation::where(function ($q) use ($currentUserId, $receiverId) {
                $q->where('user_one', $currentUserId)->where('user_two', $receiverId);
            })
            ->orWhere(function ($q) use ($currentUserId, $receiverId) {
                $q->where('user_one', $receiverId)->where('user_two', $currentUserId);
            })
            ->first();

        // If conversation doesn't exist, create it (sorted IDs for consistency)
        if (!$conversation) {
            $ids = [$currentUserId, $receiverId];
            sort($ids);
            $conversation = Conversation::create([
                'user_one' => $ids[0],
                'user_two' => $ids[1],
            ]);
        }

        // 2. Create Message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $currentUserId,
            'message' => $text,
            'is_read' => false,
        ]);

        // Return the new message data for immediate display on the client
        return response()->json([
            'status' => 'success',
            'message' => $message->load('sender:id,name'), // Load sender for display
        ]);
    }
}