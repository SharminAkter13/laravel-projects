@extends('master')

@section('page')
<div class="card">
    <div class="header pb-5 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 50px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-10 text-center">
                    <h1 class="display-2 text-white text-center">User Profile</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset('assets/img/theme/default-avatar.png') }}" class="rounded-circle img-thumbnail" width="150" alt="User Avatar">
            </div>

            <div class="col-md-8">
                <h2>{{ $user->name }}</h2>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}</p>

                <a href="{{ route('userEdit', $user->id) }}" class="btn btn-warning">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
