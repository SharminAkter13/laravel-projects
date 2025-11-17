@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <h2>Edit Job</h2>

    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Employer Email (readonly) --}}
        <div class="mb-3">
            <label class="fw-bold">Employer Email</label>
            <input type="email" name="user_email" class="form-control"
                   value="{{ auth()->user()->email }}" readonly>
        </div>

        {{-- Job Title --}}
        <div class="mb-3">
            <label class="fw-bold">Job Title</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $job->title) }}" required>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label class="fw-bold">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $job->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Job Type --}}
        <div class="mb-3">
            <label class="fw-bold">Job Type</label>
            <select name="job_type_id" class="form-control" required>
                <option value="">Select Job Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $job->job_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Job Location --}}
        <div class="mb-3">
            <label class="fw-bold">Job Location</label>
            <select name="job_location_id" class="form-control" required>
                <option value="">Select Location</option>
                @foreach($locations as $loc)
                    <option value="{{ $loc->id }}" {{ $job->job_location_id == $loc->id ? 'selected' : '' }}>
                        {{ $loc->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Company Name --}}
        <div class="mb-3">
            <label class="fw-bold">Company Name</label>
            <input type="text" name="company_name" class="form-control"
                   value="{{ old('company_name', $job->company_name) }}">
        </div>

        {{-- Website --}}
        <div class="mb-3">
            <label class="fw-bold">Company Website</label>
            <input type="url" name="website" class="form-control"
                   value="{{ old('website', $job->website) }}">
        </div>

        {{-- Tagline --}}
        <div class="mb-3">
            <label class="fw-bold">Tagline</label>
            <input type="text" name="tagline" class="form-control"
                   value="{{ old('tagline', $job->tagline) }}">
        </div>

        {{-- Tags --}}
        <div class="mb-3">
            <label class="fw-bold">Tags (comma-separated)</label>
            <input type="text" name="tags" class="form-control"
                   value="{{ old('tags', $job->tags) }}">
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $job->description) }}</textarea>
        </div>

        {{-- Application Email --}}
        <div class="mb-3">
            <label class="fw-bold">Application Email</label>
            <input type="email" name="application_email" class="form-control"
                   value="{{ old('application_email', $job->application_email) }}">
        </div>

        {{-- Application URL --}}
        <div class="mb-3">
            <label class="fw-bold">Application URL</label>
            <input type="url" name="application_url" class="form-control"
                   value="{{ old('application_url', $job->application_url) }}">
        </div>

        {{-- Closing Date --}}
        <div class="mb-3">
            <label class="fw-bold">Closing Date</label>
            <input type="date" name="closing_date" class="form-control"
                   value="{{ old('closing_date', optional($job->closing_date)->format('Y-m-d')) }}">
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="fw-bold">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $job->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $job->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        {{-- Cover Image --}}
        <div class="mb-3">
            <label class="fw-bold">Cover Image</label>
            <input type="file" name="cover_image" class="form-control">

            @if($job->cover_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $job->cover_image) }}" width="120" class="border rounded">
                </div>
            @endif
        </div>

        <button class="btn btn-success">Update Job</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
