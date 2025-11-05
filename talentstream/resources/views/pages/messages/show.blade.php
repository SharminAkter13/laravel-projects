@extends('master')
@section('content')
<div class="container mt-4">
    <h4>Chat with {{ $receiver->name }}</h4>

    <div id="chat-box" class="card mt-3">
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            @foreach($messages as $msg)
                <div class="mb-2 {{ $msg->sender_id == Auth::id() ? 'text-end' : '' }}">
                    <div class="p-2 rounded {{ $msg->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }}">
                        {{ $msg->message }}
                        <div class="text-muted small">{{ $msg->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <form id="messageForm" action="{{ route('messages.store') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Type a message..." required>
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </form>
</div>

<script>
document.querySelector('#messageForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = this;
    const data = new FormData(form);

    const res = await fetch(form.action, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: data
    });

    const json = await res.json();
    if (json.success) {
        const chatBox = document.querySelector('#chat-box .card-body');
        const newMsg = `
            <div class="mb-2 text-end">
                <div class="p-2 rounded bg-primary text-white">
                    ${json.message.message}
                    <div class="text-muted small">Just now</div>
                </div>
            </div>`;
        chatBox.insertAdjacentHTML('beforeend', newMsg);
        form.reset();
        chatBox.scrollTop = chatBox.scrollHeight;
    }
});
</script>
@endsection
