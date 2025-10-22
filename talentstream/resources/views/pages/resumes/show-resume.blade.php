@extends('master')

@section('page')
<div class="container mt-4 p-5">
  <div class="card shadow-sm">
    <div class="card-header bg-info text-white">
      <h4>{{ $resume->name }}’s Resume</h4>
    </div>

    <div class="card-body">
      <p><strong>Email:</strong> {{ $resume->email }}</p>
      <p><strong>Profession:</strong> {{ $resume->profession_title }}</p>
      <p><strong>Location:</strong> {{ $resume->location }}</p>
      <p><strong>Website:</strong> {{ $resume->web }}</p>
      <p><strong>Hourly Rate:</strong> {{ $resume->pre_hour }}</p>
      <p><strong>Age:</strong> {{ $resume->age }}</p>

      <hr>
      <h5 class="text-primary">🎓 Education</h5>
      <ul>
        @foreach($resume->educations as $edu)
          <li><strong>{{ $edu->degree }}</strong> — {{ $edu->school }} ({{ $edu->edu_from }} - {{ $edu->edu_to }})</li>
        @endforeach
      </ul>

      <h5 class="text-primary">💼 Experience</h5>
      <ul>
        @foreach($resume->experiences as $exp)
          <li><strong>{{ $exp->title }}</strong> at {{ $exp->company_name }} ({{ $exp->exp_from }} - {{ $exp->exp_to }})</li>
        @endforeach
      </ul>

      <h5 class="text-primary">🧠 Skills</h5>
      <ul>
        @foreach($resume->skills as $skill)
          <li>{{ $skill->skill_name }} — {{ $skill->skill_percent }}%</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
