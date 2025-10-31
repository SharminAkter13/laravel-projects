@extends('master')
@section('page')

<div class="container mt-4 p-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">All Resumes</h4>
        <a href="{{ route('resumes.create') }}" class="btn btn-light btn-sm">+ Add Resume</a>    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Profession</th>
            <th>Location</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($resumes as $resume)
            <tr>
              <td>{{ $resume->id }}</td>
              <td>{{ $resume->name }}</td>
              <td>{{ $resume->email }}</td>
              <td>{{ $resume->profession_title }}</td>
              <td>{{ $resume->location }}</td>
              <td>
                <a href="{{ route('resumes.show', $resume->id) }}" class="btn btn-info btn-sm">View</a>
                <form action="{{ route('resumes.destroy', $resume->id) }}" method="POST" style="display:inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this resume?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center">No resumes found.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
