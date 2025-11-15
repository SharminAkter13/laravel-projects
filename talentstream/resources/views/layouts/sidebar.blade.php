@php
 $user = auth()->user();
 $role = $user->isRole('admin') ? 'admin' : ($user->isRole('candidate') ? 'candidate' : ($user->isRole('employer') ? 'employer' : null));
@endphp

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" 
    id="sidenav-main" 
    style="z-index: 1030;"> <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
   aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
  </button>

    <a class="navbar-brand pt-2 fw-bold text-danger fs-4" href="{{ url('/home') }}">
   <img src="{{ asset('assets/img/brand/favicon.ico') }}" class="navbar-brand-img" alt="Logo">
   <span>TalentStream</span>
  </a>

    <ul class="nav align-items-center d-md-none">
   {{-- Mobile notifications and profile menu logic... --}}
  </ul>

    <div class="collapse navbar-collapse" id="sidenav-collapse-main">

   {{-- Collapse header (Mobile) logic... --}}

   <ul class="navbar-nav">
        <li class="nav-item">
     @if($role === 'admin')
      <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
       <i class="ni ni-tv-2 text-primary"></i> Admin Dashboard
      </a>
     @elseif($role === 'candidate')
      <a class="nav-link {{ request()->is('candidate/dashboard*') ? 'active' : '' }}" href="{{ route('candidate.dashboard') }}">
       <i class="ni ni-tv-2 text-primary"></i> Candidate Dashboard
      </a>
     @elseif($role === 'employer')
      <a class="nav-link {{ request()->is('employer/dashboard*') ? 'active' : '' }}" href="{{ route('employer.dashboard') }}">
       <i class="ni ni-tv-2 text-primary"></i> Employer Dashboard
      </a>
     @endif
    </li>

    @if($role === 'admin')
     {{-- ----------------- ADMIN MENU: All backend management links ----------------- --}}
     <h6 class="navbar-heading text-muted">Management</h6>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
       <i class="ni ni-circle-08 text-blue"></i> Users
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
       <i class="ni ni-bullet-list-67 text-orange"></i> Categories
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('candidates*') ? 'active' : '' }}" href="{{ route('candidates.index') }}">
       <i class="ni ni-hat-3 text-yellow"></i> Candidates
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('companies*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
       <i class="ni ni-hat-3 text-yellow"></i> Company
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('employers*') ? 'active' : '' }}" href="{{ route('employers.index') }}">
       <i class="ni ni-briefcase-24 text-teal"></i> Employers
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('jobs*') ? 'active' : '' }}" href="{{ route('jobs.index') }}">
       <i class="ni ni-briefcase-24 text-green"></i> Jobs
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('applications*') ? 'active' : '' }}" href="{{ route('applications.index') }}">
       <i class="ni ni-folder-17 text-indigo"></i> Applications
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('resumes*') ? 'active' : '' }}" href="{{ route('resumes.index') }}">
       <i class="ni ni-folder-17 text-indigo"></i> Resumes
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('job_alerts*') ? 'active' : '' }}" href="{{ route('job_alerts.index') }}">
       <i class="ni ni-bell-55 text-info"></i> Job Alerts
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('bookmarks*') ? 'active' : '' }}" href="{{ route('bookmarks.index') }}">
       <i class="ni ni-calendar-grid-58 text-purple"></i> Job Bookmarks
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('job-views*') ? 'active' : '' }}" href="{{ route('job_views.index') }}">
       <i class="ni ni-eye-81 text-red"></i> Job Views
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('job_locations*') ? 'active' : '' }}" href="{{ route('job_locations.index') }}">
       <i class="ni ni-pin-3 text-danger"></i> Job Locations
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('packages*') ? 'active' : '' }}" href="{{ route('packages.index') }}">
       <i class="ni ni-box-2 text-primary"></i> Packages
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('employer_packages*') ? 'active' : '' }}" href="{{ route('employer_packages.index') }}">
       <i class="ni ni-box-2 text-info"></i> Employer Packages
      </a>
     </li>

    @elseif($role === 'candidate')
     {{-- ----------------- CANDIDATE MENU ----------------- --}}
     <li class="nav-item">
      <a class="nav-link {{ request()->is('portal_pages/browse-jobs*') ? 'active' : '' }}" href="{{ url('portal_pages/browse-jobs') }}">
       <i class="ni ni-briefcase-24 text-green"></i> Browse Jobs
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('portal_pages/job-alert*') ? 'active' : '' }}" href="{{ url('portal_pages/job-alert') }}">
       <i class="ni ni-bell-55 text-info"></i> Job Alerts
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('applications*') ? 'active' : '' }}" href="{{ route('applications.index') }}">
       <i class="ni ni-folder-17 text-yellow"></i> My Applications
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('bookmarks*') ? 'active' : '' }}" href="{{ route('bookmarks.index') }}">
       <i class="ni ni-calendar-grid-58 text-purple"></i> Saved Jobs
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('resumes*') ? 'active' : '' }}" href="{{ route('resumes.index') }}">
       <i class="ni ni-paper-diploma text-danger"></i> My Resume
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('chat*') ? 'active' : '' }}" href="{{ route('chat.index') }}">
          <i class="fas fa-comments text-primary"></i> Messenger
      </a>
    </li>

    @elseif($role === 'employer')
     {{-- ----------------- EMPLOYER MENU ----------------- --}}
     <li class="nav-item">
      <a class="nav-link {{ request()->is('post-job*') ? 'active' : '' }}" href="{{ route('portal.job.create') }}">
       <i class="ni ni-briefcase-24 text-teal"></i> Post Job
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('jobs*') ? 'active' : '' }}" href="{{ url('jobs') }}">
       <i class="ni ni-folder-17 text-indigo"></i> Manage Jobs
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('applicants*') ? 'active' : '' }}" href="{{ route('applications.index') }}">
       <i class="ni ni-single-02 text-pink"></i> Job Applicants
      </a>
     </li>
     <li class="nav-item">
      <a class="nav-link {{ request()->is('employer_packages*') ? 'active' : '' }}" href="{{ route('employer_packages.index') }}">
       <i class="ni ni-box-2 text-info"></i> My Packages
      </a>
     </li>
          <li class="nav-item">
      <a class="nav-link {{ request()->is('chat*') ? 'active' : '' }}" href="{{ route('chat.index') }}">
          <i class="fas fa-comments text-primary"></i> Messenger
      </a>
    </li>

    @endif
   </ul>

      <h6 class="navbar-heading text-muted mt-3">Account</h6>
   <ul class="navbar-nav">
    <li class="nav-item">
     <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ url('/profile') }}">
      <i class="ni ni-single-02 text-pink"></i> My Profile
     </a>
    </li>
   
   </ul>
  </div>
 </div>
</nav>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
 @csrf
</form>