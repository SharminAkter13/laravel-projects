@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Add Category</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th> 
                        <th>Active</th> 
                        <th>Order</th> 
                        <th>Jobs Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        {{-- New: Display the image if image_path is set --}}
                        <td>
                            @if($category->image_path)
                                {{-- Assuming public storage link. Adjust asset() or storage::url() as needed --}}
                                <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" style="max-height: 50px; width: auto;">
                            @else
                                N/A
                            @endif
                        </td>
                        {{-- New: Display Is Active status --}}
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        {{-- New: Display Sort Order --}}
                        <td>{{ $category->sort_order }}</td>
                        
                        <td>{{ $category->jobs->count() }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
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