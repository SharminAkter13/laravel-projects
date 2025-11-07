<div {{-- This div is the root of the Livewire component --}}>
    {{-- wire:poll is a fallback to refresh the counts every 60 seconds --}}
    <ul class="navbar-nav align-items-center d-none d-md-flex" wire:poll.60s="loadData">
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

            <li class="nav-item dropdown mx-2" wire:ignore.self>
                <a class="nav-link position-relative" href="#" id="navbarDropdownMessages" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    title="Messages">
                    <i class="fas fa-envelope fa-lg text-dark"></i>
                    @if($unreadMessages > 0)
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                            {{ $unreadMessages }}
                        </span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-end shadow-sm"
                    aria-labelledby="navbarDropdownMessages" style="width: 450px;">

                    <h6 class="dropdown-header">Recent Messages</h6>

                    @forelse($latestMessages as $message)
                        {{-- Use the 'chat.index' route you defined, passing the conversation ID if needed --}}
                        <a href="{{ route('chat.index', ['conversationId' => $message->conversation->id]) }}"
                            class="dropdown-item d-flex align-items-start {{ $message->is_read ? 'text-muted' : 'fw-bold' }}">
                            <div class="me-2">
                                <i class="ni ni-chat-round text-primary"></i>
                            </div>
                            <div>
                                <div class="small text-muted">{{ $message->created_at->diffForHumans() }}</div>
                                <span>{{ Str::limit($message->message, 50) }}</span>
                                <div class="small text-secondary">with {{ $message->partner->name ?? 'Unknown' }}</div>
                            </div>
                        </a>
                    @empty
                        <div class="dropdown-item text-center text-muted">
                            No messages yet
                        </div>
                    @endforelse

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('chat.index') }}" class="dropdown-item text-center text-primary fw-bold">
                        View all conversations
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown mx-2" wire:ignore.self>
                <a class="nav-link position-relative" href="#" id="navbarDropdownNotifications" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Notifications">
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
                            class="dropdown-item d-flex align-items-start {{ $notification->is_read ? 'text-muted' : 'fw-bold' }}">
                            <div class="me-2">
                                <i class="ni ni-bell-55 text-warning"></i>
                            </div>
                            <div>
                                <div class="small text-muted">{{ $notification->created_at->diffForHumans() }}</div>
                                <span>{{ Str::limit($notification->message, 60) }}</span>
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
                                <small class="text-muted">({{ Auth::user()->role->name ?? 'User' }})</small>
                            </span>
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-sm">
                    <a href="{{ url('profile') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i> <span>My profile</span>
                    </a>
                    <a href="{{ url('settings') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i> <span>Settings</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </li>
        @endguest
    </ul>
</div>