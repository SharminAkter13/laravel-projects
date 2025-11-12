<div class="header">
  <section id="intro" class="section-intro">
    <div class="logo-menu">
      <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
          {{-- Brand + Toggler --}}
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

          {{-- Collapsible Nav --}}
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
              <li class="{{ request()->routeIs('portal.home') ? 'active' : '' }}">
                <a href="{{ route('portal.home') }}">Home</a>
              </li>

              {{-- Candidate Menu --}}
              @auth
                @if(auth()->user()->role?->name === 'candidate')
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('browse.jobs') }}">Browse Jobs</a></li>
                      <li><a href="{{ route('browse.categories') }}">Job Categories</a></li>
                      <li><a href="{{ route('resume.create') }}">Add Resume</a></li>
                      <li><a href="{{ route('manage.resumes') }}">Manage Resumes</a></li>
                      <li><a href="{{ route('job.alerts') }}">Job Alerts</a></li>
                      <li><a href="{{ route('applications.manage') }}">My Applications</a></li>
                    </ul>
                  </li>
                @endif
              @endauth

              {{-- Employer Menu --}}
              @auth
                @if(auth()->user()->role?->name === 'employer')
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('portal.job.create') }}">Post New Job</a></li>
                      <li><a href="{{ route('manage.jobs') }}">Manage Jobs</a></li>
                      <li><a href="{{ route('applications.manage') }}">View Applications</a></li>
                      <li><a href="{{ route('browse.resumes') }}">Browse Resumes</a></li>
                    </ul>
                  </li>
                @endif
              @endauth

              {{-- Guest Menu --}}
              @guest
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Explore <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('browse.jobs') }}">Browse Jobs</a></li>
                    <li><a href="{{ route('browse.resumes') }}">Browse Resumes</a></li>
                    <li><a href="{{ route('browse.categories') }}">Job Categories</a></li>
                  </ul>
                </li>
              @endguest

              <li><a href="{{ route('about') }}">About</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>

            {{-- Right side --}}
            <ul class="nav navbar-nav navbar-right">
              {{-- Post Job Button --}}
              @auth
                @if(auth()->user()->role?->name === 'employer')
                  <li class="left"><a href="{{ route('portal.job.create') }}"><i class="ti-pencil-alt"></i> Post A Job</a></li>
                @endif
              @else
                <li class="left"><a href="{{ route('portal.job.create') }}"><i class="ti-pencil-alt"></i> Post A Job</a></li>
              @endauth

              {{-- Authentication Links --}}
              @guest
                <li class="right"><a href="{{ route('login') }}"><i class="ti-lock"></i> Log In</a></li>
              @else
                <li class="dropdown right">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="ti-user"></i> My Account <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    {{-- Role-Based Dashboard --}}
                    @if(auth()->user()->role?->name === 'admin')
                      <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @elseif(auth()->user()->role?->name === 'candidate')
                      <li><a href="{{ route('candidate.dashboard') }}">Dashboard</a></li>
                    @elseif(auth()->user()->role?->name === 'employer')
                      <li><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                    @endif

                    <li class="divider"></li>
                    <li>
                      <a href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i> {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
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

{{-- Small CSS fix for logo alignment --}}
<style>
  .logo-img {
    height: 40px;
    margin-right: 8px;
  }
  .navbar-brand {
    display: flex;
    align-items: center;
  }
</style>
