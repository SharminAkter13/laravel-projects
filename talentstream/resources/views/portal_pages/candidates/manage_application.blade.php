@extends('main')

@section('content')
<div class="container py-5">
  <h3 class="mb-4">My Job Applications</h3>

  @forelse ($applications as $application)
    <div class="applications-content mb-3 p-3 border rounded">
      <div class="row align-items-center">
        <div class="col-md-5">
          <img src="{{ asset($application->job->cover_image ?? 'assets/img/jobs/default.jpg') }}" class="me-3" style="width:80px; height:80px; object-fit:cover;">
          <h5>{{ $application->job->title }}</h5>
          <span class="text-muted">{{ $application->job->company_name }}</span>
        </div>
        <div class="col-md-3">
          <span class="badge bg-info">{{ $application->job->tags ?? 'N/A' }}</span>
        </div>
        <div class="col-md-2">
          {{ \Carbon\Carbon::parse($application->applied_date)->format('M d, Y') }}
        </div>
        <div class="col-md-2">
          <span class="badge {{ $application->status == 'active' ? 'bg-success' : 'bg-danger' }}">
            {{ ucfirst($application->status) }}
          </span>
        </div>
      </div>
    </div>
  @empty
    <p class="text-center text-muted">You haven't applied for any jobs yet.</p>
  @endforelse

  <div class="mt-3">
    {{ $applications->links() }}
  </div>
</div>
@endsection
