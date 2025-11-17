@extends('master')

@section('page')
{{-- Changed the container to occupy the full width and added internal padding --}}
<div class="container-fluid p-4 mt-5"> 
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Edit Employer Package</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('employer_packages.update', $employerPackage->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Employer <span class="text-danger">*</span></label>
                    <select name="employer_id" class="form-control" required>
                        @foreach($employers as $employer)
                            <option value="{{ $employer->id }}" {{ $employerPackage->employer_id == $employer->id ? 'selected' : '' }}>
                                {{ $employer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Package <span class="text-danger">*</span></label>
                    <select name="package_id" class="form-control" required>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" {{ $employerPackage->package_id == $package->id ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Start Date</label>
                    <input type="datetime-local" name="start_date" class="form-control" value="{{ old('start_date', $employerPackage->start_date ? date('Y-m-d\TH:i', strtotime($employerPackage->start_date)) : '') }}">
                </div>

                <div class="mb-3">
                    <label>End Date</label>
                    <input type="datetime-local" name="end_date" class="form-control" value="{{ old('end_date', $employerPackage->end_date ? date('Y-m-d\TH:i', strtotime($employerPackage->end_date)) : '') }}">
                </div>
                
                {{-- These fields might correspond to the AM/PM fields in the image, 
                     but are just generic text inputs in your code. --}}
                <div class="mb-3">
                    <label>Status</label>
                    <input type="text" name="status" class="form-control" value="{{ old('status', $employerPackage->status) }}">
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection