<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Conversation;

class NotificationBadge extends Component
{
    // Public properties hold the state
    public $unreadCount = 0;
    public $latestNotifications = [];

    public $unreadMessages = 0;
    public $latestMessages = [];
    
    // --- Real-Time Listener ---
    
    /**
     * Listens for the 'new-message' broadcast event on any 'chat.*' channel.
     * This replaces your custom window.Echo.channel JavaScript listener.
     */
    #[On('echo:chat.*,new-message')]
    public function updateMessageBadge()
    {
        // Re-run the data loading method to fetch the new message count and content
        $this->loadData();
    }

    // --- Data Loading ---

    public function loadData()
    {
        if (!Auth::check()) {
            return;
        }

        $userId = Auth::id();

        // 🔔 Notifications
        $this->unreadCount = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();
        
        $this->latestNotifications = Notification::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // 💬 Messages
        
        // Count unread messages (sent by someone else in your conversations)
        $this->unreadMessages = Message::whereHas('conversation', function ($q) use ($userId) {
                $q->where('user_one', $userId)->orWhere('user_two', $userId);
            })
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->count();
            
        // Get the latest messages for the dropdown menu
        $this->latestMessages = Message::with(['sender', 'conversation'])
            ->whereHas('conversation', function ($q) use ($userId) {
                $q->where('user_one', $userId)->orWhere('user_two', $userId);
            })
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($message) use ($userId) {
                // Determine the chat partner to display their name
                $conversation = $message->conversation;
                $partnerId = ($conversation->user_one == $userId) ? $conversation->user_two : $conversation->user_one;
                $message->partner = \App\Models\User::find($partnerId);
                return $message;
            });
    }
    
    // Lifecycle hook to run when the component is first loaded
    public function mount()
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.notification-badge');
    }
}