@extends('main')
@section('content')

<div id="content">
    <div class="container">        
        <div class="row">
            
            <!-- Sidebar (fixed width column) -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="right-sideabr">
                    <div class="inner-box">
                        <h4>Manage Account</h4>
                        <ul class="lest item">
                            <li><a href="{{ route('manage.resumes') }}">My Resume</a></li>
                            <li><a href="{{ route('bookmarks.index') }}">Bookmarked Jobs</a></li>
                            <li>
                                <a href="{{ route('notifications.index') }}">
                                    Notifications 
                                    <span class="notinumber">
                                        {{ auth()->user()?->notifications()->where('is_read', false)->count() ?? 0 }}
                                    </span>
                                </a>
                            </li>
                        </ul>

                        <h4>Manage Job</h4>
                        <ul class="lest item">
                            <li><a class="active" href="{{ route('manage.jobs') }}">Manage Jobs</a></li>
                            <li><a href="{{ route('applications.index') }}">Manage Applications</a></li>                    
                            <li><a href="{{ route('portal.job.create') }}">Post a New Job</a></li>                    
                        </ul>

                        <ul class="lest">
                            <li><a href="{{ route('profile') }}">Profile Settings</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Job Management (main content area) -->
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="job-alerts-item candidates">
                    <h3 class="alerts-title">Manage Jobs</h3>

                    <div class="alerts-list">
                        <div class="row font-weight-bold">
                            <div class="col-md-3"><p>Title</p></div>
                            <div class="col-md-3"><p>Type</p></div>
                            <div class="col-md-3"><p>Location</p></div>
                            <div class="col-md-3"><p>Status</p></div>
                        </div>
                    </div>

                    @forelse ($jobs as $job)
                    <div class="alerts-content">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h4>{{ $job->title }}</h4>
                                <span class="location">
                                    <i class="ti-location-pin"></i>
                                    {{ optional($job->location)->name ?? 'N/A' }}
                                </span>
                            </div>                    
                            <div class="col-md-3">
                                <p><span class="full-time">{{ optional($job->jobType)->name ?? 'N/A' }}</span></p>
                            </div>
                            <div class="col-md-3">
                                <div class="can-img">
                                    <a href="#"><img src="{{ asset('portal/assets/img/jobs/candidates.png') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if ($job->status == 'active')
                                    <p><i class="ti-check text-success"></i> Active</p>
                                @else
                                    <p><i class="ti-close text-danger"></i> Inactive</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        <p class="mt-3 text-center">No jobs found. <a href="#">Post your first job!</a></p>
                    @endforelse

                    <!-- Pagination -->
                    <br>
                    <div class="text-center">
                        {{ $jobs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>      
</div>

@endsection
