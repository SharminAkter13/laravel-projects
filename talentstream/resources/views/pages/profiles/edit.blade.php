@extends('master')

@section('page')
<div class="container">
    <h1>Edit Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username', $profile->username) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="form-control">
        </div>

        <!-- Add other fields similarly -->

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
