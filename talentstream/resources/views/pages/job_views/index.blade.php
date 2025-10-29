@extends('master')

@section('page')
<div class="container">
    <h1>Job Views</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Job</th>
                <th>Viewer</th>
                <th>Viewed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($views as $view)
            <tr>
                <td>{{ $view->job->title }}</td>
                <td>{{ $view->viewer->name }}</td>
                <td>{{ $view->viewed_at ?? $view->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
