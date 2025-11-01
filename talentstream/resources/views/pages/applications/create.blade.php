@extends('main')

@section('content')

<div class="container-fluid p-4"> <!-- Added padding around the card -->
    <div class="card shadow p-8 m-8"> <!-- Increased padding inside the card -->
        <h2 class="mb-4">Apply for Job: {{ $job->title }}</h2>
        <p><strong>Company:</strong> {{ $job->company_name ?? 'N/A' }}</p>
        <p class="mb-4"><strong>Location:</strong> {{ $job->location ?? 'Not specified' }}</p>

        @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <form action="{{ route('applications.store', ['job' => $job->id]) }}" method="POST" class="mt-4 p-3 border rounded-3 bg-light">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">

            <div class="mb-3">
                <label for="resume_submitted" class="form-label">Resume Submission Date</label>
                <input type="datetime-local" name="resume_submitted" id="resume_submitted" class="form-control" value="{{ old('resume_submitted') }}" required>
                @error('resume_submitted')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_letter" class="form-label">Cover Letter (optional)</label>
                <textarea name="cover_letter" id="cover_letter" class="form-control" rows="4">{{ old('cover_letter') }}</textarea>
                @error('cover_letter')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary me-2">Back to Job Details</a>
                <button type="submit" class="btn btn-success">Submit Application</button>
            </div>
        </form>
    </div>
</div>

@endsection
