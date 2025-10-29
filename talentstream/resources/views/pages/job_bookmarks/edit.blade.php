@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <h2>Edit Job</h2>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="user_email" class="form-control" value="{{ $job->user_email }}" required>
        </div>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $job->title }}" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @if($job->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ $job->company_name }}">
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ $job->location }}">
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active" @if($job->status=='active') selected @endif>Active</option>
                <option value="inactive" @if($job->status=='inactive') selected @endif>Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
            @if($job->cover_image)
                <img src="{{ asset('storage/'.$job->cover_image) }}" alt="cover" width="100" class="mt-2">
            @endif
        </div>
        <button class="btn btn-success">Update Job</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
