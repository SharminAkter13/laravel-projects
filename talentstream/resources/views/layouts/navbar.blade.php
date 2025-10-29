<nav class="navbar navbar-top navbar-expand-md navbar-light bg-light fixed-top shadow-sm" id="navbar-main">
  <div class="container-fluid">

    <!-- Brand -->
    <a class="h4 mb-0 text-dark text-uppercase d-none d-lg-inline-block nav-link fw-bold" href="{{ url('/dashboard') }}">
      Dashboard
    </a>

    <!-- Search Form -->
    <form class="navbar-search navbar-search-light form-inline mr-3 d-none d-md-flex ml-lg-auto">
      <div class="form-group mb-0">
        <div class="input-group input-group-alternative">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
          </div>
          <input class="form-control" placeholder="Search" type="text">
        </div>
      </div>
    </form>

    <!-- Laravel Auth Links -->
    <ul class="navbar-nav align-items-center d-none d-md-flex">
      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @endif
      @else
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="User Avatar" src="{{ asset('assets/img/theme/team-4-800x800.jpg') }}">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm font-weight-bold">
                  {{ Auth::user()->name }}
                  <small class="text-muted">
                    ({{ Auth::user()->role->name ?? 'No Role' }})
                  </small>
                </span>
              </div>
            </div>
          </a>

          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class="dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>

            <a href="{{ url('profile') }}" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>

            <a href="{{ url('profile') }}" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>

            <a href="{{ url('profile') }}" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>

            <a href="{{ url('profile') }}" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>

            <div class="dropdown-divider"></div>

            <!-- Logout Form -->
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      @endguest
    </ul>
  </div>
</nav>
