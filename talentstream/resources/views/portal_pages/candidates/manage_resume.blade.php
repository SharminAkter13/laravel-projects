@extends('main')

@section('content')
<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Manage Resumes</h2>
          <ol class="breadcrumb">
            <li><a href="#"><i class="ti-home"></i> Home</a></li>
            <li class="current">Manage Resumes</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="content">
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="right-sideabr">
          <div class="inner-box">
            <h4>Manage Account</h4>
            <ul class="lest item">
              <li><a href="#">My Resume</a></li>
              <li><a href="#">Bookmarked Jobs</a></li>
              <li><a href="#">Notifications</a></li>
            </ul>
            <h4>Manage Job</h4>
            <ul class="lest item">
              <li><a href="#">Manage Jobs</a></li>
              <li><a href="#">Manage Applications</a></li>
              <li><a class="active" href="{{ route('manage.resumes') }}">Manage Resume</a></li>
            </ul>
            <ul class="lest">
              <li><a href="{{ route('password.request') }}">Change Password</a></li>
              <li><a href="{{ route('logout') }}">Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="job-alerts-item candidates">
          <h3 class="alerts-title">Manage Resumes</h3>

          @forelse($resumes as $resume)
            <div class="manager-resumes-item">
              <div class="manager-content">
                <img class="resume-thumb" 
                     src="{{ $resume->cover_image ? asset('storage/' . $resume->cover_image) : asset('portal/assets/img/jobs/avatar.jpg') }}" 
                     alt="{{ $resume->name }}">
                <div class="manager-info">
                  <div class="manager-name">
                    <h4><a href="#">{{ $resume->name }}</a></h4>
                    <h5>{{ $resume->profession_title ?? 'N/A' }}</h5>
                  </div>
                  <div class="manager-meta">
                    <span class="location"><i class="ti-location-pin"></i> {{ $resume->location ?? 'Not specified' }}</span>
                    <span class="rate"><i class="ti-time"></i> {{ $resume->pre_hour ? '$' . $resume->pre_hour . ' per hour' : 'Rate not set' }}</span>
                  </div>
                </div>
              </div>
              <div class="update-date">
                <p class="status">
                  <strong>Updated on:</strong> {{ $resume->updated_at->format('M d, Y') }}
                </p>
                <div class="action-btn">
                  <a class="btn btn-xs btn-gray" href="#">Hide</a>
                  <a class="btn btn-xs btn-gray" href="#">Edit</a>
                  <a class="btn btn-xs btn-danger" href="#">Delete</a>
                </div>
              </div>
            </div>
          @empty
            <p>No resumes found. <a href="#">Create one now</a>.</p>
          @endforelse

          <a class="btn btn-common btn-sm mt-3" href="{{ route('resume.create') }}">Add new resume</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
