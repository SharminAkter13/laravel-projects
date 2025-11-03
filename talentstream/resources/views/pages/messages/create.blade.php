@extends('master')

@section('page')
<div class="container mt-5 p-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Add Package</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('packages.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Price ($)</label>
                    <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                    @error('price')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Duration (days)</label>
                    <input type="number" name="duration_days" class="form-control" value="{{ old('duration_days') }}">
                    @error('duration_days')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Features</label>
                    <textarea name="features" class="form-control">{{ old('features') }}</textarea>
                    @error('features')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">Save</button>
                    <a href="{{ route('packages.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
