<div class="container-fluid p-4">

    <div class="row gx-0" style="min-height: 70vh; border: 1px solid #ddd; border-radius: 8px;">

        {{-- Conversation List --}}
        <div class="col-md-4 border-end" style="overflow-y: auto;">
            <h5 class="p-3 border-bottom m-0">Chats</h5>

            {{-- Start New Chat --}}
            <div class="p-3 border-bottom">
                <form wire:submit.prevent="startConversation">
                    <div class="input-group">
                        <select wire:model="newUserId" class="form-select" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success">Start Chat</button>
                    </div>
                </form>
            </div>

            {{-- Conversation List --}}
            <ul class="list-group list-group-flush">
                @forelse($conversations as $conv)
                    @php
                        $partner = ($conv->user_one == auth()->id()) 
                            ? \App\Models\User::find($conv->user_two) 
                            : \App\Models\User::find($conv->user_one);
                        $lastMessage = $conv->messages->first();
                    @endphp
                    <li class="list-group-item list-group-item-action
                        @if($selectedConversationId == $conv->id) active @endif"
                        style="cursor: pointer;"
                        wire:click="selectConversation({{ $conv->id }})">
                        <div>
                            <strong>{{ $partner->name ?? 'Unknown User' }}</strong>
                            <span class="float-end small text-muted">
                                {{ $conv->updated_at->diffForHumans() }}
                            </span>
                        </div>
                        <small class="text-truncate d-block">
                            {{ \Illuminate\Support\Str::limit($lastMessage->message ?? 'Start a conversation', 40) }}
                        </small>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted">No conversations yet.</li>
                @endforelse
            </ul>
        </div>

        {{-- Chat Area --}}
        <div class="col-md-8 d-flex flex-column">
            @if($selectedConversationId)
                <div class="p-3 border-bottom bg-light">
                    @php
                        $currentConv = $conversations->firstWhere('id', $selectedConversationId);
                        $partnerId = ($currentConv->user_one == auth()->id()) ? $currentConv->user_two : $currentConv->user_one;
                        $partnerName = \App\Models\User::find($partnerId)->name ?? 'Chat Partner';
                    @endphp
                    <h5>Chat with: {{ $partnerName }}</h5>
                </div>

                {{-- Messages --}}
                <div id="chat-box" class="p-3 flex-grow-1" style="overflow-y: auto; max-height: calc(70vh - 120px);">
                    @forelse($messages as $msg)
                        <div class="d-flex mb-2 @if($msg->sender_id == auth()->id()) justify-content-end @endif">
                            <div class="card p-2 @if($msg->sender_id == auth()->id()) bg-primary text-white @else bg-light @endif" style="max-width: 75%;">
                                <strong>{{ $msg->sender->name }}:</strong>
                                <div>{{ $msg->message }}</div>
                                <small class="text-end @if($msg->sender_id == auth()->id()) text-light @else text-muted @endif">
                                    {{ $msg->created_at->format('H:i') }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted">Start the conversation!</div>
                    @endforelse
                </div>

                {{-- Input Form --}}
                <div class="p-3 border-top">
                    <form wire:submit.prevent="sendMessage">
                        <div class="input-group">
                            <input type="text" wire:model.live="messageText" class="form-control" placeholder="Type a message..." required>
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="flex-grow-1 d-flex justify-content-center align-items-center text-muted">
                    Please select a conversation to view messages.
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:initialized', () => {
    const chatBox = document.getElementById('chat-box');

    function scrollToBottom() {
        if (chatBox) {
            setTimeout(() => { chatBox.scrollTop = chatBox.scrollHeight; }, 0);
        }
    }

    scrollToBottom();
    Livewire.on('messageSent', scrollToBottom);
    Livewire.hook('morph.finished', scrollToBottom);
});
</script>
