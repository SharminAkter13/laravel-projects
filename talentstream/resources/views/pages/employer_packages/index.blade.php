@extends('master')

@section('page')
<div class="container p-5 mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Employer Packages</h3>
            <a href="{{ route('employer_packages.create') }}" class="btn btn-primary">Add Package to Employer</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Employer</th>
                            <th>Package</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employerPackages as $ep)
                        <tr>
                            <td>{{ $ep->employer->name ?? 'N/A' }}</td>
                            <td>{{ $ep->package->name ?? 'N/A' }}</td>
                            <td>{{ $ep->start_date }}</td>
                            <td>{{ $ep->end_date }}</td>
                            <td>{{ $ep->status }}</td>
                            <td>
                                <a href="{{ route('employer_packages.edit', $ep->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('employer_packages.destroy', $ep->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No employer packages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $employerPackages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
