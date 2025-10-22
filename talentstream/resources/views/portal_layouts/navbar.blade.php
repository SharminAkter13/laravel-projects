<!-- Header Section Start -->

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
            <a class="navbar-brand d-flex align-items-center mt-2" href="{{ route('home') }}">
              <img src="{{ asset('portal/assets/img/favicon.ico') }}" alt="TalentStream Logo" class="me-2 logo-img">
              <h2 class="fw-bold text-dark mb-0">TalentStream</h2>
            </a>
          </div>
          <!-- Cleaned up structure here -->
          <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
              <li>
                <a class="active" href="{{ route('home') }}">Home</a>
              </li>

              <li>
                <a href="#">Pages</a>
                <ul class="dropdown">
                  <li><a href="{{ url('/about') }}">About</a></li>
                  <li><a href="{{ route('add-resume') }}">Add Resume</a></li>
                  <li><a href="{{ route('manage-resume') }}">Manage Resume</a></li>
                  <li><a href="{{ route('browse-jobs') }}">Browse Jobs</a></li>
                  <li><a href="{{ route('browse-categories') }}">Browse Categories</a></li>
                  <li><a href="{{ route('job-alert') }}">Job Alert</a></li>
                  <li><a href="{{ route('add-job') }}">Add Job</a></li>
                  <li><a href="{{ route('manage-job') }}">Manage Job</a></li>
                  <li><a href="{{ route('browse-resume') }}">Browse Resume</a></li>
                  <li><a href="{{ route('manage-application') }}">Manage Application</a></li>
                </ul>
              </li>

              <li>
                <a href="#">Candidates</a>
                <ul class="dropdown">
                  <li><a href="{{ route('browse-jobs') }}">Browse Jobs</a></li>
                  <li><a href="{{ route('browse-categories') }}">Browse Categories</a></li>
                  <li><a href="{{ route('add-resume') }}">Add Resume</a></li>
                  <li><a href="{{ route('manage-resume') }}">Manage Resumes</a></li>
                  <li><a href="{{ route('job-alert') }}">Job Alerts</a></li>
                </ul>
              </li>

              <li>
                <a href="#">Employers</a>
                <ul class="dropdown">
                  <li><a href="{{ route('add-job') }}">Add Job</a></li>
                  <li><a href="{{ route('manage-job') }}">Manage Jobs</a></li>
                  <li><a href="{{ route('manage-application') }}">Manage Applications</a></li>
                  <li><a href="{{ route('browse-resume') }}">Browse Resumes</a></li>
                </ul>
              </li>

              <li>
                <a href="{{ route('about') }}"> About</a>
              </li>
              <li>
                <a href="{{ route('contact') }}"> Contact</a>
              </li>
            </ul>

            <ul class="nav navbar-nav navbar-right float-right">
              <li class="left"><a href="{{ route('post-job') }}"><i class="ti-pencil-alt"></i> Post A Job</a></li>

              <!-- Authentication Logic -->

              @guest
              <!-- Guest: Show Login Link pointing to the standard 'login' route -->
              <li class="right"><a href="{{ route('login') }}"><i class="ti-lock"></i> Log In</a></li>
              @else
              <!-- Authenticated: Show My Account and Logout Link -->
              <li class="right"><a href="{{ route('my-account') }}"><i class="ti-user"></i> My Account</a>
              <ul>
              <li class="right">
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
<!-- Header Section End -->