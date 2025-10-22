@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Job Alerts</h5>
            <a href="{{ route('job_alerts.create') }}" class="btn btn-primary btn-sm">+ Create Alert</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @forelse($jobAlerts as $alert)
                <div class="alerts-content border-bottom py-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <h5>{{ $alert->title }}</h5>
                            @if($alert->location)
                                <span class="text-muted"><i class="ti-location-pin"></i> {{ $alert->location }}</span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <p>{{ $alert->keywords ?? '-' }}</p>
                        </div>
                        <div class="col-md-2">
                            <span class="badge bg-{{ $alert->contract_type == 'full‑time' ? 'success' : 'warning' }}">
                                {{ ucfirst($alert->contract_type) }}
                            </span>
                        </div>
                        <div class="col-md-2">
                            <span>{{ ucfirst($alert->frequency) }}</span>
                        </div>
                        <div class="col-md-2 text-end">
                            @can('update', $alert)
                                <a href="{{ route('job_alerts.edit', $alert->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @endcan
                            @can('delete', $alert)
                                <form action="{{ route('job_alerts.destroy', $alert->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this job alert?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No job alerts found.</p>
            @endforelse

            <div class="mt-3">
                {{ $jobAlerts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
