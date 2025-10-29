<div class="header">
  <section id="intro" class="section-intro">
    <div class="logo-menu">
      <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand d-flex align-items-center mt-2" href="{{ route('portal.home') }}">
              <img src="{{ asset('portal/assets/img/favicon.ico') }}" alt="TalentStream Logo" class="me-2 logo-img">
              <h2 class="fw-bold text-dark mb-0">TalentStream</h2>
            </a>
          </div>

          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
              <li><a class="active" href="{{ route('portal.home') }}">Home</a></li>

              {{-- Candidate Menu --}}
              @auth
                @if(auth()->user()->role?->name === 'candidate')
                  <li>
                    <a href="#">Services </a>
                    <ul class="dropdown">
                      <li><a href="{{ route('browse-jobs') }}">Browse Jobs</a></li>
                      <li><a href="{{ route('browse-categories') }}">Job Categories</a></li>
                      <li><a href="{{ route('add-resume') }}">Add Resume</a></li>
                      <li><a href="{{ route('manage-resume') }}">Manage Resumes</a></li>
                      <li><a href="{{ route('job-alert') }}">Job Alerts</a></li>
                      <li><a href="{{ route('manage-application') }}">My Applications</a></li>
                    </ul>
                  </li>
                @endif
              @endauth

              {{-- Employer Menu --}}
              @auth
                @if(auth()->user()->role?->name === 'employer')
                  <li>
                    <a href="#">Services</a>
                    <ul class="dropdown">
                      <li><a href="{{ route('add-job') }}">Post New Job</a></li>
                      <li><a href="{{ route('manage-job') }}">Manage Jobs</a></li>
                      <li><a href="{{ route('manage-application') }}">View Applications</a></li>
                      <li><a href="{{ route('browse-resume') }}">Browse Resumes</a></li>
                    </ul>
                  </li>
                @endif
              @endauth

              {{-- Guest Menu --}}
              @guest
                <li>
                  <a href="#">Explore</a>
                  <ul class="dropdown">
                    <li><a href="{{ route('browse-jobs') }}">Browse Jobs</a></li>
                    <li><a href="{{ route('browse-resume') }}">Browse Resumes</a></li>
                    <li><a href="{{ route('browse-categories') }}">Job Categories</a></li>
                  </ul>
                </li>
              @endguest

              <li><a href="{{ route('about') }}">About</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right float-right">
              {{-- Post Job Button --}}
              @auth
                @if(auth()->user()->role === 'employer')
                  <li class="left"><a href="{{ route('post-job') }}"><i class="ti-pencil-alt"></i> Post A Job</a></li>
                @endif
              @else
                <li class="left"><a href="{{ route('post-job') }}"><i class="ti-pencil-alt"></i> Post A Job</a></li>
              @endauth

              {{-- Authentication Links --}}
              @guest
                <li class="right"><a href="{{ route('login') }}"><i class="ti-lock"></i> Log In</a></li>
                <li class="right"><a href="{{ route('register') }}"><i class="ti-user"></i> Register</a></li>
              @else
                <li class="right">
                  <a href="{{ route('my-account') }}"><i class="ti-user"></i> My Account</a>
                  <ul class="dropdown">
                    {{-- ✅ Role-Based Dashboard --}}
                    @if(auth()->user()->role?->name === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}"> Dashboard</a></li>
                    @elseif(auth()->user()->role?->name === 'candidate')
                        <li><a href="{{ route('candidate.dashboard') }}"> Dashboard</a></li>
                    @elseif(auth()->user()->role?->name === 'employer')
                        <li><a href="{{ route('employer.dashboard') }}"> Dashboard</a></li>
                    @endif
                    <li>
                      <a href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i> {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
  </section>
</div>
