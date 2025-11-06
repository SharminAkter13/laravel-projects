@extends('master')

@section('content')
<div class="container py-4" id="chat-container">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Chat with {{ $receiver->name }}</h5>
      <a href="{{ route('messages.index') }}" class="btn btn-sm btn-light">Back</a>
    </div>

    <div class="card-body chat-box p-3" id="chat-box" 
         style="height: 500px; overflow-y: auto; background-color: #f9f9f9;">
      @foreach ($messages as $message)
        <div class="d-flex mb-3 {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
          <div class="p-2 rounded {{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }}" style="max-width: 70%;">
            {{ $message->message }}
            <div class="small text-muted text-end">{{ $message->created_at->diffForHumans() }}</div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="card-footer bg-white border-0">
      <form id="sendMessageForm" class="d-flex">
        <input type="hidden" id="receiver_id" value="{{ $receiver->id }}">
        <input type="text" id="messageInput" class="form-control me-2" placeholder="Type a message..." autocomplete="off">
        <button type="submit" class="btn btn-primary">Send</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatBox = document.getElementById('chat-box');
    const form = document.getElementById('sendMessageForm');
    const messageInput = document.getElementById('messageInput');
    const receiverId = document.getElementById('receiver_id').value;

    // Auto-scroll to bottom
    chatBox.scrollTop = chatBox.scrollHeight;

    // Handle form submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const message = messageInput.value.trim();
        if (message === '') return;

        fetch(`/messages/send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                receiver_id: receiverId,
                message: message
            })
        })
        .then(res => res.json())
        .then(data => {
            // Append message instantly
            appendMessage(data.message.message, true);
            messageInput.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    });

    // Function to append new messages
    function appendMessage(message, isSender = false) {
        const wrapper = document.createElement('div');
        wrapper.className = `d-flex mb-3 ${isSender ? 'justify-content-end' : 'justify-content-start'}`;

        wrapper.innerHTML = `
            <div class="p-2 rounded ${isSender ? 'bg-primary text-white' : 'bg-light text-dark'}" style="max-width: 70%;">
                ${message}
                <div class="small text-muted text-end">just now</div>
            </div>
        `;
        chatBox.appendChild(wrapper);
    }

    // Real-time updates (Pusher / Laravel Echo)
    @if(Auth::check())
    Echo.private('chat.{{ Auth::id() }}')
        .listen('MessageSent', (e) => {
            if (e.message.sender_id === parseInt(receiverId)) {
                appendMessage(e.message.message, false);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    @endif
});
</script>
@endpush
