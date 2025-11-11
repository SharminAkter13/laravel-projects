@extends('master')
@section('page')
<div class="container mt-4 p-5">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Employers</h4>
      <a href="{{ route('employers.create') }}" class="btn btn-primary btn-sm">Add Employer</a>
    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success ">{{ session('success') }}</div>
      @endif

      <div class="table-responsive">  
    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Company</th>
          <th>Website</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($employers as $e)
        <tr>
          <td>{{ $e->user->name }}</td>
          <td>{{ $e->user->email }}</td>
          <td>{{ $e->company->name ?? 'N/A' }}</td>
          <td>{{ $e->website }}</td>
          <td>{{ $e->phone }}</td>
          <td>{{ $e->address }}</td>
          <td>
            <a href="{{ route('employers.edit', $e->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('employers.destroy', $e->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div> <!-- End .table-responsive -->
    </div>
  </div>
</div>
@endsection