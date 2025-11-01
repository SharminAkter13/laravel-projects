@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Applications</h3>
        </div>
        <div class="card-body">
          @if($applications->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Job</th>
                            <th>Candidate</th>
                            <th>Status</th>
                            <th>Resume Submitted</th>
                            <th>Applied Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $app)
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td>{{ $app->job->title }}</td>
                            <td>{{ $app->candidate->name }}</td>
                            <td>{{ ucfirst($app->status) }}</td>
                            <td>{{ \Carbon\Carbon::parse($app->resume_submitted)->format('Y-m-d H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($app->applied_date)->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-center mb-0">No applications found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
