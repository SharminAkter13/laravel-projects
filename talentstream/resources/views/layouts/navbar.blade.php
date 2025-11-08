@php
use App\Models\Notification;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

$unreadCount = 0;
$latestNotifications = collect([]);
$unreadMessages = 0;
$latestMessages = collect([]);

if (Auth::check()) {
    // 🔔 Notifications
    $unreadCount = Notification::where('user_id', Auth::id())
        ->where('is_read', false)
        ->count();

    $latestNotifications = Notification::where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

    // 💬 Messages (fixed)
    $conversationIds = Conversation::where('user_one', Auth::id())
        ->orWhere('user_two', Auth::id())
        ->pluck('id');

    $unreadMessages = Message::whereIn('conversation_id', $conversationIds)
        ->where('sender_id', '!=', Auth::id()) // only messages sent by others
        ->where('is_read', false)
        ->count();

    $latestMessages = Message::whereIn('conversation_id', $conversationIds)
        ->where('sender_id', '!=', Auth::id())
        ->with('sender')
        ->latest()
        ->take(5)
        ->get();
}
@endphp

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

        <li class="nav-item mx-2"> <a class="nav-link position-relative" href="{{ route('chat.index') }}" id="navbarDropdownMessages" role="button"
             data-bs-placement="bottom" title="Messages"> <i class="fas fa-envelope fa-lg text-dark"></i>

            @if($unreadMessages > 0)
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                {{ $unreadMessages }}
              </span>
            @endif
          </a>
        </li>
        <li class="nav-item dropdown mx-2">
          <a class="nav-link position-relative" href="#" id="navbarDropdownNotifications" role="button"
             data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
             data-bs-placement="bottom" title="Notifications">

            <i class="fas fa-bell fa-lg text-dark"></i>

            @if($unreadCount > 0)
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                {{ $unreadCount }}
              </span>
            @endif
          </a>

          <div class="dropdown-menu dropdown-menu-end shadow-sm"
               aria-labelledby="navbarDropdownNotifications" style="width: 450px;">

            <h6 class="dropdown-header">Notifications</h6>

            @forelse($latestNotifications as $notification)
              <a href="{{ route('notifications.index') }}"
                 class="dropdown-item d-flex align-items-start mark-as-read"
                 data-id="{{ $notification->id }}">
                <div class="me-2">
                  <i class="ni ni-bell-55 text-warning"></i>
                </div>
                <div>
                  <div class="small text-muted">{{ $notification->created_at->diffForHumans() }}</div>
                  <span class="{{ $notification->is_read ? 'text-muted' : 'fw-bold' }}">
                    {{ Str::limit($notification->message, 60) }}
                  </span>
                </div>
              </a>
            @empty
              <div class="dropdown-item text-center text-muted">
                No new notifications
              </div>
            @endforelse

            <div class="dropdown-divider"></div>
            <a href="{{ route('notifications.index') }}" class="dropdown-item text-center text-primary fw-bold">
              View all
            </a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="User Avatar" src="{{ asset('assets/img/theme/team-4-800x800.jpg') }}">
              </span>
              <div class="media-body ms-2 d-none d-lg-block">
                <span class="mb-0 text-sm fw-bold">
                  {{ Auth::user()->name }}
                  <small class="text-muted">({{ Auth::user()->role->name ?? 'No Role' }})</small>
                </span>
              </div>
            </div>
          </a>

          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-sm">
            <div class="dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="{{ url('profile') }}" class="dropdown-item">
              <i class="ni ni-single-02"></i> <span>My profile</span>
            </a>
            <a href="{{ url('settings') }}" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i> <span>Settings</span>
            </a>
            <a href="{{ url('activity') }}" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i> <span>Activity</span>
            </a>
            <a href="{{ url('support') }}" class="dropdown-item">
              <i class="ni ni-support-16"></i> <span>Support</span>
            </a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="ni ni-user-run"></i> <span>Logout</span>
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

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Enable Bootstrap tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

    // 🔔 AJAX Mark As Read (Notifications)
    document.querySelectorAll('.mark-as-read').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            fetch(`/notifications/${this.dataset.id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            }).then(res => {
                if (res.ok) {
                    this.classList.remove('fw-bold');
                    this.querySelector('span').classList.add('text-muted');
                }
                window.location.href = "{{ route('notifications.index') }}";
            });
        });
    });

    // 💬 AJAX Mark As Read (Messages)
    // NOTE: This logic for messages is now only relevant if you want to click a specific message
    // inside the chat area to mark it read, not for the icon itself. The icon now navigates.
    document.querySelectorAll('.message-mark-read').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            fetch(`/messages/${this.dataset.id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            }).then(res => {
                if (res.ok) {
                    this.classList.remove('fw-bold');
                    this.classList.add('text-muted');
                }
                window.location.href = this.getAttribute('href');
            });
        });
    });
});
</script>

<script>
@if(Auth::check())
Echo.private('chat.{{ Auth::id() }}')
    .listen('MessageSent', (e) => {
        let badge = document.querySelector('#navbarDropdownMessages .badge.bg-danger');
        if (!badge) {
            const newBadge = document.createElement('span');
            newBadge.className = 'badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle';
            newBadge.textContent = '1';
            // The message icon link still uses the ID 'navbarDropdownMessages'
            document.querySelector('#navbarDropdownMessages').appendChild(newBadge);
        } else {
            badge.textContent = parseInt(badge.textContent.trim()) + 1;
        }

    });
@endif
</script>