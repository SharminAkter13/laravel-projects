@extends('master')

@section('page')

<div class="container">
    <h2 class="mb-4">My Saved Jobs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @if($bookmarks->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Saved Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookmarks as $bookmark)
                    <tr>
                        <td>{{ $bookmark->job->title }}</td>
                        <td>{{ $bookmark->job->company_name ?? 'N/A' }}</td>
                        <td>{{ $bookmark->saved_date ? $bookmark->saved_date->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('jobs.show', $bookmark->job->id) }}" class="btn btn-sm btn-primary">View</a>

                            <form action="{{ route('bookmarks.destroy', $bookmark->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this bookmark?')">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No jobs bookmarked yet.</p>
    @endif
</div>
@endsection
