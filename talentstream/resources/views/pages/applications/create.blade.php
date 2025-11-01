@extends('main')

@section('content')

<!-- Page Header Start -->
<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
  <div class="container">
    <div class="row">         
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Apply for Job</h2>
          <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="ti-home"></i> Home</a></li>
            <li class="current">Apply for Job</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page Header End -->    

<!-- Content Section Start -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-9 col-md-offset-2">
        <div class="page-ads box">

          {{-- Flash messages --}}
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="form-ad" action="{{ route('applications.store', ['job' => $job->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">

            <div class="divider mb-3">
              <h3>Job Details</h3>
            </div>
            <div class="form-group">
              <label class="control-label">Job Title</label>
              <input type="text" class="form-control" value="{{ $job->title }}" disabled>
            </div>

            <div class="form-group">
              <label class="control-label">Company</label>
              <input type="text" class="form-control" value="{{ $job->company_name ?? 'N/A' }}" disabled>
            </div>

            <div class="form-group">
              <label class="control-label">Location</label>
              <input type="text" class="form-control" value="{{ $job->location ?? 'Not specified' }}" disabled>
            </div>

            <div class="divider mb-3">
              <h3>Your Application</h3>
            </div>

            <div class="form-group">
              <label class="control-label">Upload Resume <span>(PDF, DOC, or DOCX)</span></label>
              <div class="upload-button">
                <button type="button" class="btn btn-common btn-sm">Browse</button>
                <input id="resume_file" type="file" name="resume" accept=".pdf,.doc,.docx" required>
              </div>
              @error('resume')
                <small class="text-danger">{{ $message }}</small>
              @enderror
              <p class="note">Please upload your most recent resume in PDF or Word format.</p>
            </div>

            <div class="form-group">
              <label class="control-label">Cover Letter (optional)</label>
              <textarea name="cover_letter" class="form-control" rows="6" placeholder="Write your cover letter here...">{{ old('cover_letter') }}</textarea>
              @error('cover_letter')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-secondary">
                <i class="ti-arrow-left"></i> Back to Job Details
              </a>
              <button type="submit" class="btn btn-common">
                Submit Application
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Content Section End -->

@endsection
