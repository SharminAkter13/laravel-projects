@extends('master')

@section('page')
<form action="{{ route('bookmarks.store', $job->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-warning">
        <i class="fa fa-bookmark"></i> Save Job
    </button>
</form>
@endsection
