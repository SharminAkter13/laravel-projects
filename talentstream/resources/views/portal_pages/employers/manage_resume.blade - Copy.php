@extends('main')
@section('content')

<!-- Header Section Start -->
<div class="header">
  <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand logo" href="{{ route('home') }}">
          <img src="{{ asset('portal/assets/img/logo.png') }}" alt="TalentStream Logo">
        </a>
      </div>

      <div class="collapse navbar-collapse" id="navbar">
        <!-- =========================== -->
        <!-- MAIN NAVIGATION ITEMS -->
        <!-- =========================== -->
        <ul class="nav navbar-nav">
          <li><a href="{{ route('home') }}">Home</a></li>

          @guest
            {{-- Guest (Not Logged In) --}}
            <li><a href="{{ route('jobs.index') }}">Browse Jobs</a></li>
            <li><a href="{{ route('companies.index') }}">Employers</a></li>
            <li><a href="{{ route('blog.index') }}">Blog</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
          @endguest

          @auth
            {{-- Candidate --}}
            @if(auth()->user()->role == 'candidate')
              <li><a href="{{ route('jobs.index') }}">Browse Jobs</a></li>
              <li><a href="{{ route('applications.index') }}">My Applications</a></li>
              <li><a href="{{ route('resume.index') }}">My Resume</a></li>
              <li><a href="{{ route('saved-jobs.index') }}">Saved Jobs</a></li>
            @endif

            {{-- Employer --}}
            @if(auth()->user()->role == 'employer')
              <li><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
              <li><a href="{{ route('jobs.create') }}">Post a Job</a></li>
              <li><a href="{{ route('jobs.manage') }}">Manage Jobs</a></li>
              <li><a href="{{ route('applications.manage') }}">Applications</a></li>
              <li><a href="{{ route('resumes.browse') }}">Browse Resumes</a></li>
            @endif

            {{-- Admin --}}
            @if(auth()->user()->role == 'admin')
              <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
              <li><a href="{{ route('admin.users.index') }}">Users</a></li>
              <li><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
              <li><a href="{{ route('admin.reports.index') }}">Reports</a></li>
            @endif
          @endauth
        </ul>

        <!-- =========================== -->
        <!-- RIGHT SIDE AUTH BUTTONS -->
        <!-- =========================== -->
        <ul class="nav navbar-nav navbar-right">
          @guest
            <li><a href="{{ route('login') }}"><i class="ti-lock"></i> Login</a></li>
            <li><a href="{{ route('register') }}"><i class="ti-user"></i> Register</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="ti-user"></i> {{ Auth::user()->name }} <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                @if(auth()->user()->role == 'candidate')
                  <li><a href="{{ route('resume.index') }}">My Profile</a></li>
                @elseif(auth()->user()->role == 'employer')
                  <li><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                @elseif(auth()->user()->role == 'admin')
                  <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                @endif
                <li>
                  <a href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti-power-off"></i> Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
</div>
<!-- Header Section End -->


@endsection