<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

#[Layout('master')] // Or use your dashboard master layout
class Messenger extends Component
{
    public $conversations = [];
    public $selectedConversationId = null;
    public $messages = [];
    public $messageText = '';
    public $users = [];
    public $newUserId;

    public function mount()
    {
        $this->loadConversations();
        $this->users = User::where('id', '!=', auth()->id())->get();

        if ($this->conversations->isNotEmpty()) {
            $this->selectConversation($this->conversations->first()->id);
        }
    }

    private function loadConversations()
    {
        $userId = auth()->id();
        $this->conversations = Conversation::where('user_one', $userId)
            ->orWhere('user_two', $userId)
            ->with(['messages' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->orderByDesc('updated_at')
            ->get();
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversationId = $conversationId;
        $this->dispatch('$refresh');

        $conversation = Conversation::with('messages.sender')->findOrFail($conversationId);
        $this->messages = $conversation->messages->reverse()->values();
    }

    public function startConversation()
    {
        $this->validate([
            'newUserId' => 'required|exists:users,id'
        ]);

        $conversation = Conversation::where(function ($q) {
            $q->where('user_one', auth()->id())
                ->where('user_two', $this->newUserId);
        })->orWhere(function ($q) {
            $q->where('user_one', $this->newUserId)
                ->where('user_two', auth()->id());
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one' => auth()->id(),
                'user_two' => $this->newUserId,
            ]);
        }

        $this->loadConversations();
        $this->selectConversation($conversation->id);
        $this->newUserId = null;
    }

    public function sendMessage()
    {
        $this->validate(['messageText' => 'required']);

        $conversation = Conversation::findOrFail($this->selectedConversationId);

        $message = $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $this->messageText,
        ]);

        $this->messages->push($message->load('sender'));
        $this->messageText = '';

        broadcast(new \App\Events\NewMessage($message))->toOthers();
        $this->dispatch('messageSent');

        $this->loadConversations();
    }

    public function getListeners()
    {
        if ($this->selectedConversationId) {
            return [
                'echo:chat.' . $this->selectedConversationId . ',NewMessage' => 'handleNewMessage',
            ];
        }
        return [];
    }

    public function handleNewMessage(array $event)
    {
        $incomingMessage = Message::with('sender')->find($event['message']['id']);
        if ($incomingMessage->conversation_id == $this->selectedConversationId) {
            $this->messages->push($incomingMessage);
            $this->dispatch('messageSent');
        }
        $this->loadConversations();
    }

    public function render()
    {
        return view('livewire.messenger');
    }
}
