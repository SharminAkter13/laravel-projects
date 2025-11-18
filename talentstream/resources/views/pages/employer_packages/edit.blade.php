@extends('master')

@section('page')
<div class="container-fluid p-4 mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Edit Employer Package</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('employer_packages.update', $employerPackage->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Employer --}}
                <div class="mb-3">
                    <label>Employer <span class="text-danger">*</span></label>
                    <select name="employer_id" class="form-control" required>
                        @foreach($employers as $em)
                            <option value="{{ $em->id }}" 
                                {{ $employerPackage->employer_id == $em->id ? 'selected' : '' }}>
                                
                                {{ $em->company->name ?? 'No Company Assigned' }}

                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Package --}}
                <div class="mb-3">
                    <label>Package <span class="text-danger">*</span></label>
                    <select name="package_id" class="form-control" required>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}" 
                                {{ $employerPackage->package_id == $package->id ? 'selected' : '' }}>
                                
                                {{ $package->name }}

                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Start Date --}}
                <div class="mb-3">
                    <label>Start Date</label>
                    <input type="datetime-local" 
                        name="start_date" 
                        class="form-control"
                        value="{{ old('start_date', $employerPackage->start_date ? date('Y-m-d\TH:i', strtotime($employerPackage->start_date)) : '') }}">
                </div>

                {{-- End Date --}}
                <div class="mb-3">
                    <label>End Date</label>
                    <input type="datetime-local" 
                        name="end_date" 
                        class="form-control"
                        value="{{ old('end_date', $employerPackage->end_date ? date('Y-m-d\TH:i', strtotime($employerPackage->end_date)) : '') }}">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $employerPackage->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ $employerPackage->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="pending" {{ $employerPackage->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
