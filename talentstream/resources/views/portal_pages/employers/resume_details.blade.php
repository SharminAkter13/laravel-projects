@extends('main')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="manager-resumes-item">
                <div class="manager-content text-center">
                    <img class="resume-thumb mb-3" 
                         src="{{ asset('storage/' . $resume->cover_image) }}" 
                         alt="{{ $resume->name }}">
                    <h2>{{ $resume->name }}</h2>
                    <h5>{{ $resume->profession_title }}</h5>
                    <p><i class="ti-location-pin"></i> {{ $resume->location }}</p>
                    <p><i class="ti-time"></i> ${{ $resume->pre_hour }} per hour</p>
                </div>
                <div class="item-body mt-4">
                    <h4>Skills</h4>
                    <ul>
                        @foreach ($resume->skills as $skill)
                            <li>{{ $skill->skill_name }} ({{ $skill->skill_percent }}%)</li>
                        @endforeach
                    </ul>

                    <h4>Education</h4>
                    @foreach ($resume->educations as $edu)
                        <p><strong>{{ $edu->degree }}</strong> - {{ $edu->field_of_study }} at {{ $edu->school }}</p>
                    @endforeach

                    <h4>Experience</h4>
                    @foreach ($resume->experiences as $exp)
                        <p><strong>{{ $exp->title }}</strong> at {{ $exp->company_name }} ({{ $exp->exp_from }} - {{ $exp->exp_to }})</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
