@extends('master')
@section('page')
<div class="container mt-4 p-5">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Companies Management</h4>
      <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm">Add Company</a>
    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
            @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Industry</th>
            <th>Website</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($companies as $company)
          <tr>
            <td>{{ $company->name }}</td>
            <td>{{ $company->industry }}</td>
            <td>{{ $company->website }}</td>
            <td>{{ $company->contact_phone }}</td>
            <td>{{ $company->address }}</td>
            <td style="width: 150px;">
              <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete {{ $company->name }}?')">Delete</button>
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