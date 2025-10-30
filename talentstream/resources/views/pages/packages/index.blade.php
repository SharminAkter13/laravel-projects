@extends('master')
@section('page')
<div class="container mt-5 p-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Packages</h3>
            <a href="{{ route('packages.create') }}" class="btn btn-primary">Add New Package</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Duration (days)</th>
                            <th>Features</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $package)
                        <tr>
                            <td>{{ $package->name }}</td>
                            <td>${{ number_format($package->price, 2) }}</td>
                            <td>{{ $package->duration_days }}</td>
                            <td>{{ $package->features }}</td>
                            <td>
                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this package?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No packages found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $packages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection