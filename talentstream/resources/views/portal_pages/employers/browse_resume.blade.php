@extends('main')
@section('content')

<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
    <div class="container">
        <div class="row">         
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Browse Resumes</h2>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="ti-home"></i> Home</a></li>
                        <li class="current">Browse Resumes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">        
        <div class="row">
            @forelse ($resumes as $resume)
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="manager-resumes-item">
                    <div class="manager-content">
                        <a href="{{ route('browse.resumes.show', $resume->id) }}">
                            <img class="resume-thumb" 
                                 src="{{ $resume->cover_image ? asset('storage/' . $resume->cover_image) : asset('portal/assets/img/jobs/default-avatar.jpg') }}" 
                                 alt="{{ $resume->name }}">
                        </a>
                        <div class="manager-info">
                            <div class="manager-name">
                                <h4><a href="{{ route('browse.resumes.show', $resume->id) }}">{{ $resume->name }}</a></h4>
                                <h5>{{ $resume->profession_title }}</h5>
                            </div>
                            <div class="manager-meta">
                                <span class="location"><i class="ti-location-pin"></i> {{ $resume->location }}</span>
                                <span class="rate"><i class="ti-time"></i> ${{ $resume->pre_hour }} per hour</span>
                            </div>
                        </div>                    
                    </div>
                    <div class="item-body">
                        <p>Email: {{ $resume->email }}</p>
                        <p>Website: <a href="{{ $resume->web }}" target="_blank">{{ $resume->web }}</a></p>
                        <div class="tag-list">
                            @foreach ($resume->skills as $skill)
                                <span>{{ $skill->skill_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div> 
            </div>
            @empty
                <p class="text-center">No resumes available at the moment.</p>
            @endforelse
        </div>
    </div>      
</div>

@endsection
