@extends('main') 

@section('content')

    <!-- Page Header Start -->
    <div class="page-header" style="background: url({{ asset('portal/assets/img/banner1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">{{ $job->title ?? 'Job Details' }}</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('portal.home') }}"><i class="ti-home"></i> Home</a></li>
                            <li class="current">{{ $job->title ?? 'Job Details' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Job Detail Section Start -->
    <section class="job-detail section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="header-detail">
                        {{-- Job Title & Quick Info --}}
                        <div class="header-content pull-left">
                            <h3><a href="#">{{ $job->title ?? 'N/A' }}</a></h3>
                            <p><span>Date Posted: {{ $job->created_at ? $job->created_at->format('M d, Y') : 'N/A' }}</span></p>
                            <p>Monthly Salary: <strong class="price">${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}</strong></p>
                        </div>
                        
                        {{-- Company Details --}}
                        <div class="detail-company pull-right text-right">
                            <div class="img-thum">
                                {{-- Use actual company logo path or a placeholder --}}
                                <img class="img-responsive" src="{{ $job->company->logo_path ?? asset('assets/img/placeholder.jpg') }}" alt="{{ $job->company->name ?? 'Company' }}">
                            </div>
                            <div class="name">
                                <h4>{{ $job->company->name ?? 'Unknown Company' }}</h4>
                                <h5>{{ $job->company->location ?? 'Location N/A' }}</h5>
                                <p>{{ $job->company->openings_count ?? 0 }} Current jobs openings</p>
                            </div>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="clearfix">
                            <div class="meta">
                                {{-- Placeholder links. Connect to actual routes if they exist --}}
                                <span><a class="btn btn-border btn-sm" href="mailto:{{ $job->company->email ?? '' }}"><i class="ti-email"></i> Email</a></span>
                                <span><a class="btn btn-border btn-sm" href="#"><i class="ti-info-alt"></i> Job Alert</a></span>
                                <span><a class="btn btn-border btn-sm" href="#"><i class="ti-save"></i> Save This job</a></span>
                                <span><a class="btn btn-border btn-sm" href="#"><i class="ti-alert"></i> Report Abuse</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- MAIN CONTENT (8 columns) --}}
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="content-area">
                        <div class="clearfix">
                            <div class="box">
                                {{-- Job Description --}}
                                <h4>Job Description</h4>
                                {!! nl2br(e($job->description ?? 'No description provided.')) !!}
                                
                                {{-- Qualifications --}}
                                @if(!empty($job->qualifications))
                                    <h4>Qualification</h4>
                                    <ul>
                                        @foreach(explode("\n", $job->qualifications) as $qualification)
                                            @if(trim($qualification))
                                                <li><i class="ti-check-box"></i>{{ trim($qualification) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- Key Responsibilities --}}
                                @if(!empty($job->responsibilities))
                                    <h4>Key responsibilities also include</h4>
                                    <ul>
                                        @foreach(explode("\n", $job->responsibilities) as $responsibility)
                                            @if(trim($responsibility))
                                                <li><i class="ti-check-box"></i>{{ trim($responsibility) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- Requirements --}}
                                @if(!empty($job->requirements))
                                    <h4>Requirements</h4>
                                    <ul>
                                        @foreach(explode("\n", $job->requirements) as $requirement)
                                            @if(trim($requirement))
                                                <li><i class="ti-check-box"></i>{{ trim($requirement) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- Benefits --}}
                                @if(!empty($job->benefits))
                                    <h4>Benefits</h4>
                                    <ul>
                                        @foreach(explode("\n", $job->benefits) as $benefit)
                                            @if(trim($benefit))
                                                <li><i class="ti-check-box"></i>{{ trim($benefit) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- Apply Button --}}
                                <a href="{{ route('applications.create', $job->id) }}" class="btn btn-common">Apply for this Job Now</a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- RELATED JOBS SECTION --}}
                    <h2 class="medium-title">Related Jobs</h2>
                    <div class="job-post-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                @forelse($relatedJobs ?? [] as $relatedJob)
                                    <div class="job-list">
                                        <div class="thumb">
                                            <a href="{{ route('jobs.show', $relatedJob->id) }}"><img src="{{ $relatedJob->company->logo_path ?? asset('portal/assets/img/placeholder.jpg') }}" alt=""></a>
                                        </div>
                                        <div class="job-list-content">
                                            <h4><a href="{{ route('jobs.show', $relatedJob->id) }}">{{ $relatedJob->title }}</a><span class="{{ $relatedJob->type_slug ?? 'full-time' }}">{{ $relatedJob->type ?? 'Full-Time' }}</span></h4>
                                            <p>{{ Str::limit($relatedJob->description, 150) }}</p>
                                            <div class="job-tag">
                                                <div class="pull-left">
                                                    <div class="meta-tag">
                                                        <span><a href="#"><i class="ti-brush"></i>{{ $relatedJob->category->name ?? 'Uncategorized' }}</a></span>
                                                        <span><i class="ti-location-pin"></i>{{ $relatedJob->location ?? 'N/A' }}</span>
                                                        <span><i class="ti-time"></i>${{ $relatedJob->salary_min }}/{{ $relatedJob->salary_type ?? 'Month' }}</span>
                                                    </div>
                                                </div>
                                                <div class="pull-right">
                                                    <div class="icon">
                                                        <i class="ti-heart"></i>
                                                    </div>
                                                    <a href="{{ route('applications.create', $relatedJob->id) }}" class="btn btn-common btn-rm">Apply Job</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No related jobs found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- SIDEBAR (4 columns) --}}
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <aside>
                        <div class="sidebar">
                            <div class="box">
                                <h2 class="small-title">Job Details</h2>
                                <ul class="detail-list">
                                    <li><a href="#">Job Id</a><span class="type-posts">Jb{{ $job->id ?? 'N/A' }}</span></li>
                                    <li><a href="#">Location</a><span class="type-posts">{{ $job->location ?? 'N/A' }}</span></li>
                                    <li><a href="#">Company</a><span class="type-posts">{{ $job->company->name ?? 'N/A' }}</span></li>
                                    <li><a href="#">Type</a><span class="type-posts">{{ $job->job_type ?? 'N/A' }}</span></li>
                                    <li><a href="#">Employment Status</a><span class="type-posts">{{ $job->status ?? 'Active' }}</span></li>
                                    <li><a href="#">Employment Type</a><span class="type-posts">{{ $job->role ?? 'N/A' }}</span></li>
                                    <li><a href="#">Positions</a><span class="type-posts">{{ $job->positions_available ?? 1 }}</span></li>
                                    <li><a href="#">Career Level</a><span class="type-posts">{{ $job->career_level ?? 'Mid' }}</span></li>
                                    <li><a href="#">Experience</a><span class="type-posts">{{ $job->experience_required ?? 0 }} Years</span></li>
                                    <li><a href="#">Gender</a><span class="type-posts">{{ $job->gender_preference ?? 'Any' }}</span></li>
                                    <li><a href="#">Nationality</a><span class="type-posts">{{ $job->nationality_restriction ?? 'Any' }}</span></li>
                                    <li><a href="#">Degree</a><span class="type-posts">{{ $job->education_level ?? 'N/A' }}</span></li>
                                </ul>
                            </div>
                            
                            {{-- Featured Jobs (Needs a featuredJobs collection from controller) --}}
                            @if(!empty($featuredJobs))
                                <div class="box">
                                    <h2 class="small-title">Featured Jobs</h2>
                                    @foreach($featuredJobs as $featuredJob)
                                        <div class="thumb">
                                            <a href="{{ route('jobs.show', $featuredJob->id) }}"><img src="{{ $featuredJob->company->logo_path ?? asset('assets/img/placeholder.jpg') }}" alt="img"></a>
                                        </div>
                                        <div class="text-box">
                                            <h4><a href="{{ route('jobs.show', $featuredJob->id) }}">{{ $featuredJob->title }}</a></h4>
                                            <p>{{ Str::limit($featuredJob->description, 50) }}</p>
                                            <a href="#" class="text"><i class="fa fa-map-marker"></i>{{ $featuredJob->location }}</a>
                                            <a href="#" class="text"><i class="fa fa-calendar"></i>{{ $featuredJob->created_at->format('M d, Y') }}</a>
                                            <strong class="price"><i class="fa fa-money"></i>${{ number_format($featuredJob->salary_min) }} - ${{ number_format($featuredJob->salary_max) }}</strong>
                                            <a href="{{ route('applications.create', $featuredJob->id) }}" class="btn btn-common btn-sm">Apply for this Job</a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Jobs Gallery / More Jobs (Needs a galleryJobs collection) --}}
                            @if(!empty($galleryJobs))
                                <div class="sidebar-jobs box">
                                    <h2 class="small-title">Jobs Gallery</h2>
                                    <ul>
                                        @foreach($galleryJobs as $galleryJob)
                                            <li>
                                                <a href="{{ route('jobs.show', $galleryJob->id) }}">{{ $galleryJob->title }}</a>
                                                <span><i class="fa fa-map-marker"></i>{{ $galleryJob->location }}</span>
                                                <span><i class="fa fa-calendar"></i>{{ $galleryJob->created_at->format('M d, Y') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- Job Detail Section End -->
@endsection
