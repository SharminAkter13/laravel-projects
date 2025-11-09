@extends('main')

@section('content')
<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
  <div class="container">
    <div class="row">         
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Job Alerts</h2>
          <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="ti-home"></i> Home</a></li>
            <li class="current">Job Alerts</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="content">
  <div class="container">        
    <div class="row">
      {{-- Sidebar --}}
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="right-sideabr">
          <div class="inner-box">
            <h4>Manage Account</h4>
            <ul class="lest item">
              {{-- ✅ FIXED: Remove or safely link resume route --}}
              {{-- If you have $resume object, you can use: route('resumes.show', $resume->id) --}}
              <li><a href="{{ route('resumes.index') }}">My Resume</a></li>
              <li><a href="#">Bookmarked Jobs</a></li>
              <li><a href="{{ route('notifications.index') }}"><span>Notifications</span></a></li>
            </ul>

            <h4>Manage Job</h4>
            <ul class="lest item">
              <li><a href="{{ route('applications.index') }}">Manage Applications</a></li>
              <li><a class="active" href="{{ route('job.alerts') }}">Job Alerts</a></li>
            </ul>

            <ul class="lest">
              <li><a href="{{ route('password.request') }}">Change Password</a></li>
              <li><a href="{{ route('logout') }}">Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>

      {{-- Main Content --}}
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="job-alerts-item">
          <h3 class="alerts-title">Job Alerts</h3>

          <div class="alerts-list">
            <div class="row">
              <div class="col-md-3"><p>Name</p></div>
              <div class="col-md-3"><p>Keywords</p></div>
              <div class="col-md-3"><p>Contract Type</p></div>
              <div class="col-md-3"><p>Frequency</p></div>
            </div>
          </div>

          @forelse ($jobAlerts as $alert)
            <div class="alerts-content">
              <div class="row">
                <div class="col-md-3">
                  <h3>{{ $alert->title }}</h3>
                  <span class="location">
                    <i class="ti-location-pin"></i> {{ $alert->location ?? 'N/A' }}
                  </span>
                </div>
                <div class="col-md-3">
                  <p>{{ $alert->keywords ?? '—' }}</p>
                </div>
                <div class="col-md-3">
                  @if (strtolower($alert->contract_type) === 'full-time')
                    <p><span class="full-time">Full-Time</span></p>
                  @else
                    <p><span class="part-time">Part-Time</span></p>
                  @endif
                </div>
                <div class="col-md-3">
                  <p>{{ ucfirst($alert->frequency) }}</p>
                </div>
              </div>
            </div>
          @empty
            <div class="text-center mt-4">
              <p>No job alerts found.</p>
            </div>
          @endforelse

          {{-- Pagination Example (if needed) --}}
          {{-- {{ $jobAlerts->links() }} --}}
        </div>
      </div>
    </div>
  </div>      
</div>
@endsection
