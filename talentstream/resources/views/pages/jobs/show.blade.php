@extends('master')

@section('page')
<!-- Page Header -->
<div class="page-header" style="background: url({{ asset('portal/assets/img/banner1.jpg') }});">
    <div class="container">
        <div class="breadcrumb-wrapper">
            <h2 class="product-title">{{ $job->title ?? 'Job Details' }}</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('portal.home') }}"><i class="ti-home"></i> Home</a></li>
                <li class="current">{{ $job->title ?? 'Job Details' }}</li>
            </ol>
        </div>
    </div>
</div>

<!-- Job Detail Section -->
<section class="job-detail section">
    <div class="container">
        <div class="row">
            <!-- MAIN CONTENT -->
            <div class="col-md-8">
                <div class="job-description box">
                    <h4>Description</h4>
                    {!! nl2br(e($job->description ?? 'No description available')) !!}

                    @if($job->requirements)
                        <h4>Requirements</h4>
                        <ul>
                            @foreach(explode("\n", $job->requirements) as $req)
                                @if(trim($req))
                                    <li><i class="ti-check-box"></i> {{ trim($req) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('applications.create', $job->id) }}" class="btn btn-common mt-3">Apply Now</a>
                </div>

                <!-- Related Jobs -->
                <h4 class="mt-5">Related Jobs</h4>
                @forelse($relatedJobs as $related)
                    <div class="job-list">
                        <h5><a href="{{ route('jobs.show', $related->id) }}">{{ $related->title }}</a></h5>
                        <p>{{ Str::limit($related->description, 100) }}</p>
                        <span>{{ $related->location->name ?? 'N/A' }}</span> | 
                        <span>{{ $related->category->name ?? 'N/A' }}</span>
                        <a href="{{ route('applications.create', $related->id) }}" class="btn btn-sm btn-common float-right">Apply</a>
                        <hr>
                    </div>
                @empty
                    <p>No related jobs found.</p>
                @endforelse
            </div>

            <!-- SIDEBAR -->
            <div class="col-md-4">
                <div class="sidebar box">
                    <h4>Job Details</h4>
                    <ul class="detail-list">
                        <li><strong>Job ID:</strong> Jb{{ $job->id }}</li>
                        <li><strong>Location:</strong> {{ $job->location->city ?? 'N/A' }}</li>
                        <li><strong>Company:</strong> {{ $job->company_name }}</li>
                        <li><strong>Category:</strong> {{ $job->category->name ?? 'N/A' }}</li>
                        <li><strong>Status:</strong> {{ ucfirst($job->status) }}</li>
                        <li><strong>Type:</strong> {{ $job->jobType->name ?? 'N/A' }}</li>
                        <li><strong>Positions:</strong> {{ $job->positions_available ?? 1 }}</li>
                    </ul>

                    @if($featuredJobs)
                        <h4 class="mt-4">Featured Jobs</h4>
                        @foreach($featuredJobs as $fjob)
                            <div class="featured-job mb-3">
                                <h5><a href="{{ route('jobs.show', $fjob->id) }}">{{ $fjob->title }}</a></h5>
                                <span>{{ $fjob->location->name ?? 'N/A' }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
