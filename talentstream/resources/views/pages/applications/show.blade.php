@extends('main')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2>Application #{{ $application->id }}</h2>
        <p><strong>Job:</strong> {{ $application->job->title }}</p>
        <p><strong>Candidate:</strong> {{ $application->candidate->name }}</p>
        <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
        <p><strong>Resume Submitted:</strong> {{ $application->resume_submitted->format('Y-m-d H:i') }}</p>
        <p><strong>Applied Date:</strong> {{ $application->applied_date->format('Y-m-d H:i') }}</p>
        <p><strong>Cover Letter:</strong> {{ $application->cover_letter ?? 'N/A' }}</p>

        <a href="{{ route('applications.index') }}" class="btn btn-primary mt-3">Back to Applications</a>
    </div>
</div>
@endsection
