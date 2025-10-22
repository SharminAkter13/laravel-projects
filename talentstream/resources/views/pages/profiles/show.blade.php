@extends('master')

@section('page')
<div class="container">
    <h1>My Profile</h1>
    <p><strong>Username:</strong> {{ $profile->username }}</p>
    <p><strong>Email:</strong> {{ $profile->email }}</p>
    <!-- Add other profile fields -->
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
