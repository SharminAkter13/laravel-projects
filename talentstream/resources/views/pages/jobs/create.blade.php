@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <h2>Create Job</h2>

    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Auto-filled Employer Email --}}
        <div class="mb-3">
            <label class="fw-bold">Employer Email</label>
            <input type="email" name="user_email" class="form-control"
                   value="{{ auth()->user()->email }}" readonly>
        </div>

        {{-- Job Title --}}
        <div class="mb-3">
            <label class="fw-bold">Job Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        {{-- Job Category --}}
        <div class="mb-3">
            <label class="fw-bold">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Job Type --}}
        <div class="mb-3">
            <label class="fw-bold">Job Type</label>
            <select name="job_type_id" class="form-control" required>
                <option value="">Select Job Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Job Location --}}
        <div class="mb-3">
            <label class="fw-bold">Job Location</label>
            <select name="job_location_id" class="form-control" required>
                <option value="">Select Location</option>
                @foreach($locations as $loc)
                    <option value="{{ $loc->id }}">{{ $loc->city }}</option>
                @endforeach
            </select>
        </div>

        {{-- Auto-filled Company Name --}}
        <div class="mb-3">
            <label class="fw-bold">Company Name</label>
            <input type="text" name="company_name" class="form-control"
                   value="{{ auth()->user()->company->name ?? '' }}" readonly>
        </div>

        {{-- Auto-filled Company Website --}}
        <div class="mb-3">
            <label class="fw-bold">Company Website</label>
            <input type="url" name="website" class="form-control"
                   value="{{ auth()->user()->company->website ?? '' }}" readonly>
        </div>

        {{-- Tagline --}}
        <div class="mb-3">
            <label class="fw-bold">Tagline</label>
            <input type="text" name="tagline" class="form-control">
        </div>

        {{-- Tags --}}
        <div class="mb-3">
            <label class="fw-bold">Tags (comma-separated)</label>
            <input type="text" name="tags" class="form-control">
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>

        {{-- Application Email --}}
        <div class="mb-3">
            <label class="fw-bold">Application Email</label>
            <input type="email" name="application_email" class="form-control">
        </div>

        {{-- Application URL --}}
        <div class="mb-3">
            <label class="fw-bold">Application URL</label>
            <input type="url" name="application_url" class="form-control">
        </div>

        {{-- Closing Date --}}
        <div class="mb-3">
            <label class="fw-bold">Closing Date</label>
            <input type="date" name="closing_date" class="form-control">
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="fw-bold">Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        {{-- Cover Image --}}
        <div class="mb-3">
            <label class="fw-bold">Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
        </div>

        <button class="btn btn-success">Create Job</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
