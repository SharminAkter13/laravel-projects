<nav class="navbar navbar-top navbar-expand-md navbar-light bg-light fixed-top shadow-sm" id="navbar-main">
    <div class="container-fluid">

        <a class="h4 mb-0 text-dark text-uppercase d-none d-lg-inline-block nav-link fw-bold" href="{{ url('/dashboard') }}">
            Dashboard
        </a>

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

        <livewire:notification-badge />
        
    </div>
</nav>

