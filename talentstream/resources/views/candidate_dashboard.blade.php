{{-- resources/views/candidate_dashboard.blade.php --}}
@extends('master')

@section('page')
<div class="container">
    <h1>Welcome, {{ auth()->user()->name }}</h1>

    {{-- Quick Stats --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Applications</h5>
                    <p class="card-text">{{ $totalApplications }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Interviews</h5>
                    <p class="card-text">{{ $totalInterviews }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Offers</h5>
                    <p class="card-text">{{ $totalOffers }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Applied Jobs Table --}}
    <div class="card">
        <div class="card-header">
            Your Applications
        </div>
        <div class="card-body">
            @if($applications->count())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Applied On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td>{{ $application->job->title }}</td>
                            <td>{{ $application->job->employer->company_name ?? 'N/A' }}</td>
                            <td>{{ ucfirst($application->status) }}</td>
                            <td>{{ $application->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>You haven't applied to any jobs yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
