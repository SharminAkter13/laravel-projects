@extends('master')
@section('content')
<div class="container mt-4">
    <h4>Send a New Message</h4>

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="receiver" class="form-label">Recipient</label>
            <select name="receiver_id" id="receiver" class="form-select" required>
                <option value="">Select a user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role->name ?? 'User' }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Send Message</button>
    </form>
</div>
@endsection
