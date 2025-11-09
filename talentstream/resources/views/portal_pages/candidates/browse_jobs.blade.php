@extends('main')
@section('content')

<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
    <div class="container">
        <div class="row">         
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Browse Job</h2>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="ti-home"></i> Home</a></li>
                        <li class="current">Browse Job</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="job-browse section">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                @foreach($jobs as $job)
                    <div class="job-list">
                        <div class="thumb">
                            <a href="{{ route('jobs.show', $job->id) }}">
                                <img src="{{ $job->image ? asset('storage/'.$job->image) : asset('portal/assets/img/jobs/default.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="job-list-content">
                            <h4>
                                <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                                <span class="{{ strtolower(str_replace(' ', '-', $job->jobType->name ?? 'Unknown')) }}">{{ $job->jobType->name ?? 'Unknown' }}</span>
                            </h4>
                            <p>{{ \Illuminate\Support\Str::limit($job->description, 150) }}</p>
                            <div class="job-tag">
                                <div class="pull-left">
                                    <div class="meta-tag">
                                        <span><i class="ti-briefcase"></i> {{ $job->category->name ?? 'N/A' }}</span>
                                        <span><i class="ti-location-pin"></i> {{ $job->jobLocation->address_and_city ?? $job->location }}</span>
                                        <span><i class="ti-time"></i> {{ $job->salary ?? 'Negotiable' }}</span>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <div class="icon">
                                        <i class="ti-heart"></i>
                                    </div>
                                    <a href="{{ route('applications.create', $job->id) }}" class="btn btn-common btn-rm">Apply Job</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $jobs->links('vendor.pagination.bootstrap-4') }}
            </div>

            <div class="col-md-3 col-sm-4">
                <aside>
                    <div class="sidebar">
                        <div class="inner-box">
                            <h3>Categories</h3>
                            <ul class="cat-list">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="#">{{ $category->name }} <span class="num-posts">{{ $category->jobs()->count() }} Jobs</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="inner-box">
                            <h3>Job Status</h3>
                            <ul class="cat-list">
                                @foreach($types as $type)
                                    <li>
                                        <a href="#">{{ $type->name }} <span class="num-posts">{{ $type->jobs_count }} Jobs</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="inner-box">
                            <h3>Locations</h3>
                            <ul class="cat-list">
                                @foreach($locations as $location)
                                    <li>
                                        <a href="#">
                                            {{ $location->address_and_city }}
                                            <span class="num-posts">{{ $location->jobs_count }} Jobs</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection