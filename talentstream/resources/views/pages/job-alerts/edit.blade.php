@extends('master')

@section('page')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Edit Job Alert</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('job_alerts.update', $jobAlert->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Alert Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $jobAlert->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keywords</label>
                    <input type="text" name="keywords" class="form-control" value="{{ $jobAlert->keywords }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ $jobAlert->location }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contract Type</label>
                    <select name="contract_type" class="form-select">
                        <option value="full‑time" {{ $jobAlert->contract_type == 'full‑time' ? 'selected' : '' }}>Full-Time</option>
                        <option value="part‑time" {{ $jobAlert->contract_type == 'part‑time' ? 'selected' : '' }}>Part-Time</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Frequency</label>
                    <select name="frequency" class="form-select">
                        <option value="daily" {{ $jobAlert->frequency == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ $jobAlert->frequency == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ $jobAlert->frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Alert</button>
                <a href="{{ route('job_alerts.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
