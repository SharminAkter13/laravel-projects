@extends('master')

@section('page')
<div class="container mt-5 p-5 ">
    <div class="card shadow ">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Applications</h3>
        </div>

        <div class="card-body">
            @if($applications->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Job</th>

                                {{-- Only show candidate info to admin/employer --}}
                                @if(auth()->user()->role?->name !== 'candidate')
                                    <th>Candidate Name</th>
                                    <th>Candidate Email</th>
                                @endif

                                <th>Status</th>
                                <th>Applied Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($applications as $app)
                                <tr>
                                    <td>{{ $app->id }}</td>
                                    <td>{{ $app->job?->title ?? 'N/A' }}</td>

                                    {{-- Only admins/employers can see candidate info --}}
                                    @if(auth()->user()->role?->name !== 'candidate')
                                        <td>{{ $app->candidate?->user?->name ?? 'N/A' }}</td>
                                        <td>{{ $app->candidate?->user?->email ?? 'N/A' }}</td>
                                    @endif

                                    <td>
                                        <span class="badge 
                                            @if($app->status === 'active') bg-success 
                                            @elseif($app->status === 'pending') bg-warning 
                                            @else bg-secondary 
                                            @endif">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>

                                    <td>{{ $app->applied_date ? \Carbon\Carbon::parse($app->applied_date)->format('Y-m-d H:i') : 'N/A' }}</td>

                                    <td>
                                        <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $applications->links() }}
                </div>
            @else
                <p class="text-center mb-0">No applications found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
