@extends('master')
@section('page')
<div class="container mt-4 p-5">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Create New Company</h4>
      <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-sm">Back to Companies</a>
    </div>
    <div class="card-body">
      <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="name">Company Name <span class="text-danger">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
          @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label for="industry">Industry</label>
          <input type="text" name="industry" id="industry" class="form-control" value="{{ old('industry') }}">
        </div>

        <div class="mb-3">
          <label for="website">Website (URL)</label>
          <input type="url" name="website" id="website" class="form-control" value="{{ old('website') }}">
        </div>

        <div class="mb-3">
          <label for="contact_phone">Contact Phone</label>
          <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone') }}">
        </div>

        <div class="mb-3">
          <label for="contact_email">Contact Email</label>
          <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email') }}">
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
        </div>

        <div class="mb-3">
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Company</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>
@endsection