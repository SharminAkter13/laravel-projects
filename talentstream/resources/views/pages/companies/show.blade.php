@extends('master')
@section('page')
<div class="container mt-4 p-5">
    <div class="card shadow-lg mb-5">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">{{ $company->name }} Details</h3>
            <div>
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning btn-sm me-2">Edit Company</a>
                <a href="{{ route('companies.index') }}" class="btn btn-light btn-sm">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Industry:</strong> {{ $company->industry ?? 'N/A' }}</p>
                    <p><strong>Website:</strong> 
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="text-primary">{{ $company->website }}</a>
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Contact Email:</strong> {{ $company->contact_email ?? 'N/A' }}</p>
                    <p><strong>Contact Phone:</strong> {{ $company->contact_phone ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Address:</strong> {{ $company->address ?? 'N/A' }}</p>
                    <p><strong>Created At:</strong> {{ $company->created_at->format('M d, Y H:i A') }}</p>
                    <p><strong>Last Updated:</strong> {{ $company->updated_at->format('M d, Y H:i A') }}</p>
                </div>
            </div>

            <h5 class="text-primary mt-3">Description</h5>
            <div class="p-3 border rounded bg-light">
                <p class="mb-0">{{ $company->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>

    {{-- Associated Employers --}}
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Associated Employers ({{ $company->employers->count() }})</h5>
        </div>
        <div class="card-body">
            @if($company->employers->isEmpty())
                <div class="alert alert-info mb-0">No employers are currently assigned to this company.</div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($company->employers as $employer)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $employer->user->name }} ({{ $employer->user->email }})
                            <span class="badge bg-primary rounded-pill">User ID: {{ $employer->user_id }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection