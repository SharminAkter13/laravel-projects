@extends('main')

@section('content')
<div class="container py-5">
  <h3 class="mb-4">Applications for "{{ $job->title }}"</h3>

  @forelse ($job->applications as $app)
    <div class="border rounded p-3 mb-3">
      <div class="d-flex justify-content-between">
        <div>
          <strong>Candidate:</strong> {{ $app->candidate->name ?? 'Unknown' }} <br>
          <small>Applied on: {{ \Carbon\Carbon::parse($app->applied_date)->format('M d, Y') }}</small>
        </div>
        <div>
          <span class="badge {{ $app->status == 'active' ? 'bg-success' : 'bg-warning' }}">
            {{ ucfirst($app->status) }}
          </span>
        </div>
      </div>
    </div>
  @empty
    <p class="text-center text-muted">No applications yet for this job.</p>
  @endforelse
</div>
@endsection
