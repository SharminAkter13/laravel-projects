@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <h2>Create Job</h2>

    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="user_email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" class="form-control">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tagline</label>
            <input type="text" name="tagline" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tags (comma-separated)</label>
            <input type="text" name="tags" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Application Email</label>
            <input type="email" name="application_email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Application URL</label>
            <input type="url" name="application_url" class="form-control">
        </div>

        <div class="mb-3">
            <label>Closing Date</label>
            <input type="date" name="closing_date" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
        </div>

        <button class="btn btn-success">Create Job</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
