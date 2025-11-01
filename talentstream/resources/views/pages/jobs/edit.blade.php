@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <h2>Edit Job</h2>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="user_email" class="form-control" value="{{ old('user_email', $job->user_email) }}" required>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $job->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $job->company_name) }}">
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website', $job->website) }}">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $job->location) }}">
        </div>

        <div class="mb-3">
            <label>Tagline</label>
            <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $job->tagline) }}">
        </div>

        <div class="mb-3">
            <label>Tags (comma-separated)</label>
            <input type="text" name="tags" class="form-control" value="{{ old('tags', $job->tags) }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $job->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Application Email</label>
            <input type="email" name="application_email" class="form-control" value="{{ old('application_email', $job->application_email) }}">
        </div>

        <div class="mb-3">
            <label>Application URL</label>
            <input type="url" name="application_url" class="form-control" value="{{ old('application_url', $job->application_url) }}">
        </div>

        <div class="mb-3">
            <label>Closing Date</label>
            <input type="date" name="closing_date" class="form-control" value="{{ old('closing_date', $job->closing_date ? $job->closing_date->format('Y-m-d') : '') }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $job->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $job->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
            @if($job->cover_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$job->cover_image) }}" alt="cover" width="100">
                </div>
            @endif
        </div>

        <button class="btn btn-success">Update Job</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
