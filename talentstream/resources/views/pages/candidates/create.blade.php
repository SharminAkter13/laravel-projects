@extends('master')
@section('page')
<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Create Candidate</h4>
            <a href="{{ route('candidates.index') }}" class="btn btn-secondary btn-sm">Back to Candidates</a>
        </div>
        <div class="card-body">
            <form action="{{ route('candidates.store') }}" method="POST">
                @csrf

                {{-- Auto-filled User ID (hidden) --}}
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Resume</label>
                    <input type="text" name="resume" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Save Candidate</button>
                <a href="{{ route('candidates.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
