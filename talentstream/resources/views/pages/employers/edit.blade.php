@extends('master')
@section('page')
<div class="container mt-4 p-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Employer</h4>
            <a href="{{ route('employers.index') }}" class="btn btn-secondary btn-sm">Back to Employers</a>
        </div>
        <div class="card-body">
            <form action="{{ route('employers.update', $employer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $employer->user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $employer->user->email) }}" required>
                </div>

                {{-- Company Dropdown (Select) - Pre-selects current company_id --}}
                <div class="mb-3">
                    <label for="company_id">Company</label>
                    <select name="company_id" id="company_id" class="form-control">
                        <option value="">Select a Company</option>
                        @foreach ($companies as $company)
                            <option 
                                value="{{ $company->id }}"
                                {{ old('company_id', $employer->company_id) == $company->id ? 'selected' : '' }}
                            >
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- AUTOFILLED FIELDS --}}
                <div class="mb-3">
                    <label for="website">Website</label>
                    {{-- Initial value is the employer's current website --}}
                    <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $employer->website) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="phone">Phone</label>
                    {{-- Initial value is the employer's current phone --}}
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $employer->phone) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    {{-- Initial value is the employer's current address --}}
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $employer->address) }}" readonly>
                </div>
                
                <button type="submit" class="btn btn-success">Update Employer</button>
                <a href="{{ route('employers.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const companySelect = document.getElementById('company_id');
        const websiteInput = document.getElementById('website');
        const phoneInput = document.getElementById('phone');
        const addressInput = document.getElementById('address');
        
        // Define the function to clear the fields (used when company is unselected)
        function clearFields() {
            websiteInput.value = '';
            phoneInput.value = '';
            addressInput.value = '';
        }

        companySelect.addEventListener('change', function () {
            const companyId = this.value;
            // Clear fields only if a selection is made to prevent overwriting initial data on page load
            if (!companyId) {
                clearFields(); 
                return; // Do nothing if no company is selected
            }

            // Fetch company details from a Laravel API endpoint
            // NOTE: This assumes the API route '/api/companies/{id}' is correctly set up
            const url = `/api/companies/${companyId}`; 

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Company not found or network error.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Assuming the API returns data with 'website', 'phone', and 'address' keys
                    // and that 'phone' maps to 'contact_phone' from the Company model
                    websiteInput.value = data.website || 'N/A';
                    phoneInput.value = data.phone || 'N/A'; // Maps to contact_phone
                    addressInput.value = data.address || 'N/A';
                })
                .catch(error => {
                    console.error('Error fetching company details:', error);
                    clearFields(); // Clear if fetch fails
                });
        });
    });
</script>
@endsection