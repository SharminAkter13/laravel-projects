@extends('master')
@section('page')

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="text-center mb-4">Edit Resume</h2>

<form action="{{ route('resumes.update', $resume->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

            <h4 class="text-primary">Basic Information</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $resume->name }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $resume->email }}" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Profession Title</label>
                    <input type="text" name="profession_title" value="{{ $resume->profession_title }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ $resume->location }}" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Cover Image</label><br>
                @if($resume->cover_image)
                    <img src="{{ asset('storage/' . $resume->cover_image) }}" class="mb-2" height="80">
                @endif
                <input type="file" name="cover_image" class="form-control">
            </div>

            <hr>
            <h4 class="text-primary mt-4">Education</h4>
            @foreach($resume->educations as $index => $edu)
                <div class="border p-3 rounded mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Degree</label>
                            <input type="text" name="educations[{{ $index }}][degree]" class="form-control" value="{{ $edu->degree }}">
                        </div>
                        <div class="col-md-4">
                            <label>Field of Study</label>
                            <input type="text" name="educations[{{ $index }}][field_of_study]" class="form-control" value="{{ $edu->field_of_study }}">
                        </div>
                        <div class="col-md-4">
                            <label>School</label>
                            <input type="text" name="educations[{{ $index }}][school]" class="form-control" value="{{ $edu->school }}">
                        </div>
                    </div>
                </div>
            @endforeach

            <hr>
            <h4 class="text-primary mt-4">Experience</h4>
            @foreach($resume->experiences as $index => $exp)
                <div class="border p-3 rounded mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Company Name</label>
                            <input type="text" name="experiences[{{ $index }}][company_name]" class="form-control" value="{{ $exp->company_name }}">
                        </div>
                        <div class="col-md-6">
                            <label>Title</label>
                            <input type="text" name="experiences[{{ $index }}][title]" class="form-control" value="{{ $exp->title }}">
                        </div>
                    </div>
                </div>
            @endforeach

            <hr>
            <h4 class="text-primary mt-4">Skills</h4>
            @foreach($resume->skills as $index => $skill)
                <div class="border p-3 rounded mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <label>Skill Name</label>
                            <input type="text" name="skills[{{ $index }}][skill_name]" class="form-control" value="{{ $skill->skill_name }}">
                        </div>
                        <div class="col-md-4">
                            <label>Skill Percent</label>
                            <input type="number" name="skills[{{ $index }}][skill_percent]" class="form-control" value="{{ $skill->skill_percent }}">
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary w-100">Update Resume</button>
            </div>
        </form>
    </div>
</div>

@endsection
