@extends('main')

@section('content')
<div class="container mt-5">
  <div class="card shadow p-4">
    <h1>{{ $job->title }}</h1>
    <p><strong>Company:</strong> {{ $job->company_name ?? 'N/A' }}</p>
    <p><strong>Location:</strong> {{ $job->location ?? 'Not specified' }}</p>
    <p><strong>Category:</strong> {{ $job->category->name ?? 'Uncategorized' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($job->status) }}</p>
    <p><strong>Description:</strong></p>
    <p>{{ $job->description }}</p>

    @if($job->cover_image)
      <div class="mt-3">
        <img src="{{ asset('storage/' . $job->cover_image) }}" alt="{{ $job->title }}" class="img-fluid rounded">
      </div>
    @endif

    <a href="{{ url('/') }}" class="btn btn-primary mt-4">Back to Home</a>
  </div>
</div>
@endsection
