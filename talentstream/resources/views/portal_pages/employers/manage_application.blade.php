@extends('main')

@section('content')
<!-- Page Header Start -->
<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
    <div class="container">
        <div class="row">         
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Manage Applications</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('portal.home') }}"><i class="ti-home"></i> Home</a></li>
                        <li class="current">Manage Applications</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End --> 

<!-- Start Content -->
<div id="content">
    <div class="container">        
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="right-sideabr">
                    <div class="inner-box">
                        <h4>Manage Account</h4>

                        @php
                            $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
                                ->where('is_read', false)
                                ->count();
                        @endphp

                        <ul class="lest item">
                            <li><a href="{{ route('resumes.index') }}">My Resume</a></li>
                            <li><a href="{{ route('bookmarks.index') }}">Bookmarked Jobs</a></li>
                            <li>
                                <a href="{{ route('notifications.index') }}">
                                    Notifications
                                    @if($unreadCount > 0)
                                        <span class="notinumber">{{ $unreadCount }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>

                        <h4>Manage Job</h4>
                        <ul class="lest item">
                            <li><a class="active" href="{{ route('applications.manage') }}">Manage Applications</a></li>
                            <li><a href="{{ route('job.alerts') }}">Job Alerts</a></li>
                        </ul>

                        <ul class="lest">
                            <li><a href="{{ route('password.request') }}">Change Password</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                   Sign Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Applications List -->
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="job-alerts-item">
                    <h3 class="alerts-title">Manage Applications</h3>

                    @forelse($applications as $application)
                    <div class="applications-content">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="thums">
                                    <img src="{{ $application->job->cover_image ? asset('storage/'.$application->job->cover_image) : asset('portal/assets/img/jobs/default.jpg') }}" alt="">
                                </div>
                                <h3>{{ $application->job->title }}</h3>
                                <span>{{ $application->job->company_name }}</span>
                            </div>
                            <div class="col-md-3">
                                <p>
                                    <span class="{{ strtolower($application->job->jobType->name ?? '') == 'full-time' ? 'full-time' : 'part-time' }}">
                                        {{ $application->job->jobType->name ?? 'N/A' }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <p>{{ \Carbon\Carbon::parse($application->applied_date)->format('M d, Y') }}</p>
                            </div>                   
                            <div class="col-md-2">
                                <p>{{ ucfirst($application->status) }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p>No applications found.</p>
                    @endforelse

                    <!-- Pagination -->
                    <br>
                    {{ $applications->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>      
</div>
<!-- End Content -->
@endsection
