@extends('master')

@section('page')
<div class="container p-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Assign Package to Employer</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('employer_packages.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Employer <span class="text-danger">*</span></label>
                    <select name="employer_id" class="form-control" required>
                        <option value="">-- Select Employer --</option>
                        @foreach($employers as $employer)
                            <option value="{{ $employer->id }}" {{ old('employer_id') == $employer->id ? 'selected' : '' }}>
                                {{ $employer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employer_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Package <span class="text-danger">*</span></label>
                    <select name="package_id" class="form-control" required>
                        <option value="">-- Select Package --</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('package_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Start Date</label>
                    <input type="datetime-local" name="start_date" class="form-control" value="{{ old('start_date') }}">
                </div>

                <div class="mb-3">
                    <label>End Date</label>
                    <input type="datetime-local" name="end_date" class="form-control" value="{{ old('end_date') }}">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <input type="text" name="status" class="form-control" value="{{ old('status') }}">
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">Save</button>
                    <a href="{{ route('employer_packages.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
