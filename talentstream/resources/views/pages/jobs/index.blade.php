@extends('master')

@section('page')

<div class="container p-5 mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Jobs List</h3>
            @if(auth()->user()->role != 'admin')
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">+ Add Job</a>
            @endif
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->category->name ?? 'N/A' }}</td>
                                <td>{{ $job->company_name ?? $job->employer->company->name ?? 'N/A' }}</td>
                                <td>{{ $job->jobLocation->city ?? 'N/A' }}</td>
                                <td>{{ $job->jobType->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($job->status == 'active') bg-success
                                        @elseif($job->status == 'pending') bg-warning
                                        @elseif($job->status == 'expired') bg-danger
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this job?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No jobs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
