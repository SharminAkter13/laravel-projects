@extends('master')

@section('page')
<!-- Page Header -->
<div class="page-header" style="background: url({{ asset('portal/assets/img/banner1.jpg') }});">
    <div class="container">
        <h2 class="product-title">All Jobs</h2>
        <ol class="breadcrumb">
            <li><a href="{{ route('portal.home') }}"><i class="ti-home"></i> Home</a></li>
            <li class="current">Jobs</li>
        </ol>
    </div>
</div>

<!-- Jobs List Section -->
<section class="jobs-list section">
    <div class="container">
        <div class="text-right mb-3">
            <a href="{{ route('jobs.create') }}" class="btn btn-primary">+ Add Job</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->category->name ?? 'N/A' }}</td>
                            <td>{{ $job->company_name }}</td>
                            <td>{{ $job->location->city ?? 'N/A' }}</td>
                            <td>{{ ucfirst($job->status) }}</td>
                            <td>
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
                            <td colspan="7" class="text-center">No jobs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    </div>
</section>
@endsection
