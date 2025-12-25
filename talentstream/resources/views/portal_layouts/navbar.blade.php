<div class="header">
  <section id="intro" class="section-intro">
    <div class="logo-menu">
      <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
          <div class="navbar-header">

            <a class="navbar-brand d-flex align-items-center mt-2" href="{{ route('portal.home') }}">
              <img src="{{ asset('portal/assets/img/favicon.ico') }}" alt="TalentStream Logo" class="me-2 logo-img">
              <h2 class="fw-bold text-dark mb-0">TalentStream</h2>
            </a>
          </div>

          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
              {{-- 1. Standard Links --}}
              <li><a class="active" href="{{ route('portal.home') }}">Home</a></li>

              {{-- 2. Role-Based Services --}}
              @auth
                @if(auth()->user()->role?->name === 'candidate')
                  <li>
                    <a href="#">Services <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown">
                      <li><a href="{{ route('browse.jobs') }}">Browse Jobs</a></li>
                      <li><a href="{{ route('browse.categories') }}">Job Categories</a></li>
                      <li><a href="{{ route('resume.create') }}">Add Resume</a></li>
                      <li><a href="{{ route('manage.resumes') }}">Manage Resumes</a></li>
                      <li><a href="{{ route('job.alerts') }}">Job Alerts</a></li>
                      <li><a href="{{ route('candidate.manage.applications') }}">My Applications</a></li>
                    </ul>
                  </li>
                @elseif(auth()->user()->role?->name === 'employer')
                  <li>
                    <a href="#">Services <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown">
                      <li><a href="{{ route('portal.job.create') }}">Post New Job</a></li>
                      <li><a href="{{ route('manage.jobs') }}">Manage Jobs</a></li>
                      <li><a href="{{ isset($job) ? route('employer.job.applications', $job->id) : '#' }}">Applications</a></li>
                      <li><a href="{{ route('browse.resumes') }}">Browse Resumes</a></li>
                    </ul>
                  </li>
                @endif
              @endauth

              {{-- 3. Guest Explore --}}
              @guest
                <li>
                  <a href="#">Explore <i class="fa fa-angle-down"></i></a>
                  <ul class="dropdown">
                    <li><a href="{{ route('browse.jobs') }}">Browse Jobs</a></li>
                    <li><a href="{{ route('browse.resumes') }}">Browse Resumes</a></li>
                    <li><a href="{{ route('browse.categories') }}">Job Categories</a></li>
                  </ul>
                </li>
              @endguest

              <li><a href="{{ route('about') }}">About</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>

              {{-- 4. Unified Action Button (Post Job) --}}
              @if(!auth()->check() || (auth()->check() && auth()->user()->role?->name === 'employer'))
                <li><a href="{{ route('portal.job.create') }}"><i class="ti-pencil-alt"></i> Post A Job</a></li>
              @endif

              {{-- 5. Authentication --}}
              @guest
                <li><a href="{{ route('login') }}"><i class="ti-lock"></i> Log In</a></li>
              @else
                <li>
                  <a href="#"><i class="ti-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                  <ul class="dropdown">
                    @if(auth()->user()->role?->name === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @elseif(auth()->user()->role?->name === 'candidate')
                        <li><a href="{{ route('candidate.dashboard') }}">Dashboard</a></li>
                    @elseif(auth()->user()->role?->name === 'employer')
                        <li><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
                    @endif
                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i> Logout
                      </a>
                    </li>
                  </ul>
                </li>
              @endguest
            </ul>

            {{-- Hidden Logout Form --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
      </nav>
    </div>
  </section>
</div>