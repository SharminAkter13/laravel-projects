@extends('master')
@section('content')
<div class="container mt-4">
    <h3>Your Messages</h3>

    <div class="list-group mt-3">
        @forelse($messages->unique('sender_id') as $msg)
            @php
                $chatUser = $msg->sender_id === $user->id ? $msg->receiver : $msg->sender;
            @endphp
            <a href="{{ route('messages.show', $chatUser->id) }}" class="list-group-item list-group-item-action">
                <strong>{{ $chatUser->name }}</strong>
                <span class="text-muted d-block">{{ Str::limit($msg->message, 50) }}</span>
            </a>
        @empty
            <p>No messages yet.</p>
        @endforelse
    </div>
</div>
@endsection
