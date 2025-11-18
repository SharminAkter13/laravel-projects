@extends('master')

@section('page')
<div class="container p-5 mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Assign Package to Employer</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('employer_packages.store') }}" method="POST">
                @csrf

                {{-- Employer Selection --}}
                @if(isset($employer))
                    {{-- Logged-in employer (auto-filled) --}}
                    <div class="mb-3">
                        <label>Employer</label>

                        <input type="text" 
                               class="form-control"
                               value="{{ $employer->company->name ?? 'No company found' }}"
                               readonly>

                        <input type="hidden" name="employer_id" value="{{ $employer->id }}">
                    </div>

                @else
                    {{-- Admin selecting employer --}}
                    <div class="mb-3">
                        <label>Employer <span class="text-danger">*</span></label>

                        <select name="employer_id" class="form-control" required>
                            <option value="">-- Select Employer --</option>
                            
                            @foreach($employers as $em)
                                <option value="{{ $em->id }}" 
                                        {{ old('employer_id') == $em->id ? 'selected' : '' }}>
                                    {{ $em->company->name ?? 'No company assigned' }}
                                </option>
                            @endforeach
                        </select>

                        @error('employer_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @endif

                <hr>

                {{-- Package Dropdown --}}
                <div class="mb-3">
                    <label>Package <span class="text-danger">*</span></label>
                    <select name="package_id" id="package_id" class="form-control" required>
                        <option value="">-- Select Package --</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}"
                                data-duration="{{ $package->duration_days }}"
                                {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->name }} ({{ $package->duration_days }} days)
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Start Date --}}
                <div class="mb-3">
                    <label>Start Date</label>
                    <input type="datetime-local" 
                           name="start_date" 
                           id="start_date" 
                           class="form-control"
                           value="{{ old('start_date', now()->format('Y-m-d\TH:i')) }}">
                </div>

                {{-- End Date --}}
                <div class="mb-3">
                    <label>End Date</label>
                    <input type="datetime-local" 
                           name="end_date" 
                           id="end_date" 
                           class="form-control"
                           value="{{ old('end_date') }}"
                           readonly>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">Save</button>
                    <a href="{{ route('employer_packages.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Auto date JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const packageSelect = document.getElementById('package_id');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    function format(d) { return d.toISOString().slice(0, 16); }

    function calcEnd() {
        const duration = parseInt(packageSelect.selectedOptions[0]?.dataset.duration);
        const start = new Date(startDateInput.value);

        if (!isNaN(start) && duration) {
            const end = new Date(start);
            end.setDate(end.getDate() + duration);
            endDateInput.value = format(end);
        }
    }

    packageSelect.addEventListener('change', calcEnd);
    startDateInput.addEventListener('change', calcEnd);

    calcEnd();
});
</script>

@endsection
