@extends('master')

@section('page')
<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Edit Category</h2>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Back to Categories</a>
        </div>
        <div class="card-body">
            {{-- UPDATED: Added enctype for file upload --}}
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                {{-- Name Field --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- NEW: Image Path (File Upload and Current Image Display) --}}
                <div class="mb-3">
                    <label for="image_path" class="form-label">Category Image (Optional)</label>
                    <input type="file" name="image_path" id="image_path" class="form-control @error('image_path') is-invalid @enderror">
                    @error('image_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($category->image_path)
                        <div class="mt-2">
                            <label>Current Image:</label>
                            {{-- Assuming public storage link. Adjust asset() or storage::url() as needed --}}
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" style="max-height: 80px; width: auto; display: block;">
                            <div class="form-check mt-2">
                                {{-- Hidden field to signal the controller to remove the image --}}
                                <input type="checkbox" name="remove_image" id="remove_image" class="form-check-input" value="1">
                                <label class="form-check-label" for="remove_image">Remove current image</label>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- NEW: Is Active (Checkbox) --}}
                <div class="mb-3 form-check">
                    <input type="hidden" name="is_active" value="0"> {{-- Hidden field ensures a value is sent if unchecked --}}
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Is Active</label>
                </div>

                {{-- NEW: Sort Order (Numeric Input) --}}
                <div class="mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $category->sort_order) }}" min="0" required>
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection