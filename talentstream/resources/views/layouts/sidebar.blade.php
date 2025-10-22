<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
      aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Brand -->
    <a class="navbar-brand pt-2 fw-bold text-danger fs-4" href="{{ url('/home') }}">
      <img src="{{ asset('assets/img/brand/favicon.ico') }}" class="navbar-brand-img" alt="Logo">
      <span >TalentStream</span>
    </a>

    <!-- User (Mobile Only) -->
    <ul class="nav align-items-center d-md-none">
      <!-- Notifications -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-link-icon" href="#" data-toggle="dropdown">
          <i class="ni ni-bell-55"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>

      <!-- Profile -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" data-toggle="dropdown">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <img alt="User" src="{{ asset('assets/img/theme/team-1-800x800.jpg') }}">
            </span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome!</h6>
          </div>
          <a href="{{ url('/profile') }}" class="dropdown-item"><i class="ni ni-single-02"></i> <span>My Profile</span></a>
          <a href="{{ url('/settings') }}" class="dropdown-item"><i class="ni ni-settings-gear-65"></i> <span>Settings</span></a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/logout') }}" class="dropdown-item"><i class="ni ni-user-run"></i> <span>Logout</span></a>
        </div>
      </li>
    </ul>

    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">

      <!-- Collapse header (Mobile) -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="{{ url('/home') }}">
              <img src="{{ asset('assets/img/brand/blue.png') }}" alt="Brand">
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main"
              aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>

      <!-- Navigation -->
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ url('/users') }}">
            <i class="ni ni-circle-08 text-blue"></i> Users
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ url('/categories') }}">
            <i class="ni ni-bullet-list-67 text-orange"></i> Categories
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('candidates*') ? 'active' : '' }}" href="{{ url('/candidates') }}">
            <i class="ni ni-hat-3 text-yellow"></i> Candidates
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('employers*') ? 'active' : '' }}" href="{{ url('/employers') }}">
            <i class="ni ni-briefcase-24 text-teal"></i> Employers
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('resumes*') ? 'active' : '' }}" href="{{ url('/resumes') }}">
            <i class="ni ni-folder-17 text-indigo"></i> Resumes
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('jobs*') ? 'active' : '' }}" href="{{ url('/jobs') }}">
            <i class="ni ni-briefcase-24 text-green"></i> Jobs
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('job-alerts*') ? 'active' : '' }}" href="{{ url('/job-alerts') }}">
            <i class="ni ni-bell-55 text-info"></i> Job Alerts
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('interviews*') ? 'active' : '' }}" href="{{ url('/interviews') }}">
            <i class="ni ni-calendar-grid-58 text-purple"></i> Interviews
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ url('/profile') }}">
            <i class="ni ni-single-02 text-pink"></i> User Profile
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ url('/login') }}">
            <i class="ni ni-key-25 text-dark"></i> Login
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ url('/register') }}">
            <i class="ni ni-circle-08 text-primary"></i> Register
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
