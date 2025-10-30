@extends('master')

@section('page')
<div class="container">
    <h2 class="mb-4">Notifications</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-sm btn-primary">Mark All as Read</button>
    </form>

    <div class="list-group">
        @forelse($notifications as $notification)
            <div class="list-group-item d-flex justify-content-between align-items-center {{ $notification->is_read ? 'bg-light' : 'bg-white' }}">
                <div>
                    <strong>{{ $notification->type ?? 'Notification' }}</strong><br>
                    <span>{{ $notification->message }}</span>
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <div class="d-flex">
                    @if(!$notification->is_read)
                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="me-2">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Mark Read</button>
                        </form>
                    @endif

                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No notifications found.</div>
        @endforelse
    </div>
</div>
@endsection
