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

                {{-- Check if a specific employer is logged in --}}
                @if(isset($loggedInEmployer))
                    {{-- 1. If logged in, display the name and use a hidden input for the ID --}}
                    <div class="mb-3">
                        <label>Employer</label>
                        <input type="text" class="form-control" value="{{ $loggedInEmployer->name }}" readonly>
                        {{-- **HIDDEN INPUT:** This submits the correct ID --}}
                        <input type="hidden" name="employer_id" value="{{ $loggedInEmployer->id }}">
                    </div>
                @else
                    {{-- 2. If no employer is logged in (e.g., an Admin is viewing), show the original dropdown --}}
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
                @endif
                
                <hr>
                
                {{-- 3. Package Dropdown --}}
                <div class="mb-3">
                    <label>Package <span class="text-danger">*</span></label>
                    <select name="package_id" id="package_id" class="form-control" required>
                        <option value="">-- Select Package --</option>
                        {{-- Note: The controller should now pass only $activePackages --}}
                        @foreach($packages as $package) 
                            <option 
                                value="{{ $package->id }}" 
                                data-duration="{{ $package->duration_days }}" 
                                {{ old('package_id') == $package->id ? 'selected' : '' }}
                            >
                                {{ $package->name }} ({{ $package->duration_days }} days)
                            </option>
                        @endforeach
                    </select>
                    @error('package_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- 4. Start Date --}}
                <div class="mb-3">
                    <label>Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', now()->format('Y-m-d\TH:i')) }}">
                </div>

                {{-- 5. End Date (will be auto-filled by JS) --}}
                <div class="mb-3">
                    <label>End Date</label>
                    {{-- The 'readonly' attribute prevents manual editing but allows the form to submit the value --}}
                    <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <input type="text" name="status" class="form-control" value="{{ old('status', 'Active') }}">
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-success">Save</button>
                    <a href="{{ route('employer_packages.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const packageSelect = document.getElementById('package_id');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        // Function to format a Date object for the datetime-local input
        function formatDateToLocalDatetime(date) {
            const yyyy = date.getFullYear();
            const MM = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
            const dd = String(date.getDate()).padStart(2, '0');
            const HH = String(date.getHours()).padStart(2, '0');
            const mm = String(date.getMinutes()).padStart(2, '0');
            
            // Expected format: YYYY-MM-DDTHH:MM
            return `${yyyy}-${MM}-${dd}T${HH}:${mm}`;
        }

        function calculateEndDate() {
            const selectedOption = packageSelect.options[packageSelect.selectedIndex];
            const durationDays = parseInt(selectedOption.getAttribute('data-duration'));
            const startDateValue = startDateInput.value;

            // Check if a package and a start date have been selected/entered
            if (durationDays && startDateValue) {
                // Parse the start date string into a JavaScript Date object
                const startDate = new Date(startDateValue);

                // Check if the date is valid
                if (!isNaN(startDate)) {
                    // Create a new Date object for the calculation
                    const endDate = new Date(startDate);
                    
                    // Add the duration in days. 
                    // Note: This automatically handles month/year rollovers.
                    endDate.setDate(endDate.getDate() + durationDays);

                    // Subtract 1 minute to make it exclusive of the end day's start time, 
                    // which is typical for calendar duration displays (e.g., 30 days ends at 23:59:59 on the 30th day)
                    // If you want the event to end *at* the same time on the end day, remove the "-1".
                    // For a 30-day package: Start 10/1 at 10:00 -> End 10/31 at 10:00.
                    // This is the simplest calculation. 
                    
                    // We will keep it simple and just add the duration to the date.
                    
                    // Format the resulting Date object for the input field
                    endDateInput.value = formatDateToLocalDatetime(endDate);
                }
            } else {
                // Clear the end date if the start date or package is not selected
                endDateInput.value = '';
            }
        }

        // 1. Run on page load if values are present (e.g., from old() data)
        calculateEndDate();
        
        // 2. Attach the function to change events
        packageSelect.addEventListener('change', calculateEndDate);
        startDateInput.addEventListener('change', calculateEndDate);
    });
</script>

@endsection