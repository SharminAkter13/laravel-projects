@extends('master')
@section('page')
<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Candidate</h4>
            <a href="{{ route('candidates.index') }}" class="btn btn-secondary btn-sm">Back to Candidates</a>
        </div>
        <div class="card-body">
            <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $candidate->user->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $candidate->user->email }}" required>
                </div>
                <div class="mb-3">
                    <label>Resume</label>
                    <input type="text" name="resume" class="form-control" value="{{ $candidate->resume }}">
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $candidate->phone }}">
                </div>
                <div class="mb-3">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $candidate->address }}">
                </div>
                <button type="submit" class="btn btn-success">Update Candidate</button>
                <a href="{{ route('candidates.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
