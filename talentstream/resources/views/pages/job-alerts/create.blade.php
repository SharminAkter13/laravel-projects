@extends('master')

@section('page')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Create Job Alert</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('job_alerts.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Alert Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keywords</label>
                    <input type="text" name="keywords" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contract Type</label>
                    <select name="contract_type" class="form-select">
                        <option value="full‑time">Full-Time</option>
                        <option value="part‑time">Part-Time</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Frequency</label>
                    <select name="frequency" class="form-select">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Create Alert</button>
                <a href="{{ route('job_alerts.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
