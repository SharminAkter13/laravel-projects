@extends('master')
@section('page')
<div class="container mt-4 p-5">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Create Employer</h4>
      <a href="{{ route('employers.index') }}" class="btn btn-secondary btn-sm">Back to Employers</a>
    </div>
    <div class="card-body">
      <form action="{{ route('employers.store') }}" method="POST">
        @csrf
        {{-- Existing Employer Details --}}
        <div class="mb-3">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        {{-- Company Dropdown --}}
        <div class="mb-3">
          <label for="company_id">Company</label>
          <select name="company_id" id="company_id" class="form-control">
            <option value="">Select a Company</option>
            @foreach ($companies as $company)
              <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
          </select>
        </div>
                
        {{-- AUTOFILLED FIELDS: Now included and made read-only --}}
        <div class="mb-3">
          <label for="website">Website</label>
          <input type="text" name="website" id="website" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="address" id="address" class="form-control" readonly>
        </div>
        
        <button type="submit" class="btn btn-success">Save Employer</button>
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
        
        function clearFields() {
            websiteInput.value = '';
            phoneInput.value = '';
            addressInput.value = '';
        }

        companySelect.addEventListener('change', function () {
            const companyId = this.value;
            clearFields(); 

            if (!companyId) {
                return; 
            }

         
            const url = `/companies/${companyId}/details`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Company not found or network error.');
                    }
                    return response.json();
                })
                .then(data => {
                    websiteInput.value = data.website || 'N/A';
                    phoneInput.value = data.phone || 'N/A';
                    addressInput.value = data.address || 'N/A';
                })
                .catch(error => {
                    console.error('Error fetching company details:', error);
                });
        });
    });
</script>
@endsection