@extends('master')

@section('page')
<div class="container p-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Edit Job Location</h3>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('job_locations.update', $jobLocation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Country <span class="text-danger">*</span></label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $jobLocation->country) }}" required>
                    @error('country')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $jobLocation->state) }}">
                    @error('state')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $jobLocation->city) }}">
                    @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control">{{ old('address', $jobLocation->address) }}</textarea>
                    @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $jobLocation->postal_code) }}">
                    @error('postal_code')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">Update</button>
                    <a href="{{ route('job_locations.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
