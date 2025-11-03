@extends('master')
@section('content')
<div class="container mt-4">
    <h4>Conversation with {{ $receiver->name }}</h4>

    <div class="card mt-3">
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            @foreach($messages as $msg)
                <div class="mb-3 {{ $msg->sender_id == Auth::id() ? 'text-end' : '' }}">
                    <div class="p-2 rounded {{ $msg->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }}">
                        {{ $msg->message }}
                        <div class="text-muted small">{{ $msg->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <form action="{{ route('messages.store') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Type a message..." required>
            <button class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
@endsection
