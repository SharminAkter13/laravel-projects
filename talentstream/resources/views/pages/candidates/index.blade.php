@extends('master')
@section('page')
<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center fw-bold">
            <span>Candidate Information</span>
            <a href="{{ route('candidates.create') }}" class="btn btn-primary btn-sm">Add Candidate</a>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidates as $c)
                    <tr>
                        <td>{{ $c->user->name }}</td>
                        <td>{{ $c->user->email }}</td>
                        <td>{{ $c->phone }}</td>
                        <td>{{ $c->address }}</td>
                        <td>
                            <a href="{{ route('candidates.edit', $c->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('candidates.destroy', $c->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection
