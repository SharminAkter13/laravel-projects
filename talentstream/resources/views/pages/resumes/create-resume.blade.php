@extends('master')

@section('page')
<div class="container mt-4 p-5">
  <div class="card shadow-sm">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0">Create Resume</h4>
    </div>

    <div class="card-body">
      <form action="{{ route('resumes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ========== BASIC INFO ========== -->
        <h5 class="mb-3 text-primary">Basic Information</h5>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label>Profession Title</label>
            <input type="text" name="profession_title" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Website</label>
            <input type="text" name="web" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Hourly Rate</label>
            <input type="text" name="pre_hour" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Cover Image</label>
            <input type="file" name="cover_image" class="form-control">
          </div>
        </div>

        <hr>

        <!-- ========== EDUCATION ========== -->
        <h5 class="text-primary">🎓 Education</h5>
        <div id="educationFields">
          <div class="edu-item border rounded p-3 mb-3 bg-light">
            <div class="row g-3">
              <div class="col-md-4">
                <input type="text" name="educations[0][degree]" placeholder="Degree" class="form-control" required>
              </div>
              <div class="col-md-4">
                <input type="text" name="educations[0][field_of_study]" placeholder="Field of Study" class="form-control">
              </div>
              <div class="col-md-4">
                <input type="text" name="educations[0][school]" placeholder="School" class="form-control">
              </div>
              <div class="col-md-6">
                <label>From</label>
                <input type="date" name="educations[0][edu_from]" class="form-control">
              </div>
              <div class="col-md-6">
                <label>To</label>
                <input type="date" name="educations[0][edu_to]" class="form-control">
              </div>
              <div class="col-12">
                <textarea name="educations[0][edu_description]" rows="2" placeholder="Description" class="form-control"></textarea>
              </div>
              <div class="col-md-10">
                <label>Institution Logo</label>
                <input type="file" name="educations[0][edu_logo]" class="form-control">
              </div>
              <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm removeEdu w-100 mt-4">×</button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" id="addEducation" class="btn btn-outline-primary btn-sm mb-3">+ Add Education</button>

        <hr>

        <!-- ========== EXPERIENCE ========== -->
        <h5 class="text-primary">💼 Experience</h5>
        <div id="experienceFields">
          <div class="exp-item border rounded p-3 mb-3 bg-light">
            <div class="row g-3">
              <div class="col-md-6">
                <input type="text" name="experiences[0][company_name]" placeholder="Company Name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <input type="text" name="experiences[0][title]" placeholder="Job Title" class="form-control">
              </div>
              <div class="col-md-6">
                <label>From</label>
                <input type="date" name="experiences[0][exp_from]" class="form-control">
              </div>
              <div class="col-md-6">
                <label>To</label>
                <input type="date" name="experiences[0][exp_to]" class="form-control">
              </div>
              <div class="col-12">
                <textarea name="experiences[0][exp_description]" rows="2" placeholder="Description" class="form-control"></textarea>
              </div>
              <div class="col-md-10">
                <label>Company Logo</label>
                <input type="file" name="experiences[0][exp_logo]" class="form-control">
              </div>
              <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm removeExp w-100 mt-4">×</button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" id="addExperience" class="btn btn-outline-primary btn-sm mb-3">+ Add Experience</button>

        <hr>

        <!-- ========== SKILLS ========== -->
        <h5 class="text-primary">🧠 Skills</h5>
        <div id="skillFields">
          <div class="skill-item border rounded p-3 mb-3 bg-light">
            <div class="row g-3">
              <div class="col-md-5">
                <input type="text" name="skills[0][skill_name]" placeholder="Skill name" class="form-control">
              </div>
              <div class="col-md-5">
                <input type="number" name="skills[0][skill_percent]" placeholder="Percent" class="form-control">
              </div>
              <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm removeSkill w-100">×</button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" id="addSkill" class="btn btn-outline-primary btn-sm mb-3">+ Add Skill</button>

        <hr>

        <div class="text-end">
          <button type="submit" class="btn btn-success">Save Resume</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  let eduCount = 1, expCount = 1, skillCount = 1;

  // Add Education
  document.getElementById('addEducation').addEventListener('click', function () {
    const container = document.getElementById('educationFields');
    const newEdu = `
      <div class="edu-item border rounded p-3 mb-3 bg-light">
        <div class="row g-3">
          <div class="col-md-4"><input type="text" name="educations[${eduCount}][degree]" placeholder="Degree" class="form-control" required></div>
          <div class="col-md-4"><input type="text" name="educations[${eduCount}][field_of_study]" placeholder="Field of Study" class="form-control"></div>
          <div class="col-md-4"><input type="text" name="educations[${eduCount}][school]" placeholder="School" class="form-control"></div>
          <div class="col-md-6"><label>From</label><input type="date" name="educations[${eduCount}][edu_from]" class="form-control"></div>
          <div class="col-md-6"><label>To</label><input type="date" name="educations[${eduCount}][edu_to]" class="form-control"></div>
          <div class="col-12"><textarea name="educations[${eduCount}][edu_description]" rows="2" placeholder="Description" class="form-control"></textarea></div>
          <div class="col-md-10"><label>Institution Logo</label><input type="file" name="educations[${eduCount}][edu_logo]" class="form-control"></div>
          <div class="col-md-2 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm removeEdu w-100 mt-4">×</button></div>
        </div>
      </div>`;
    container.insertAdjacentHTML('beforeend', newEdu);
    eduCount++;
  });

  // Add Experience
  document.getElementById('addExperience').addEventListener('click', function () {
    const container = document.getElementById('experienceFields');
    const newExp = `
      <div class="exp-item border rounded p-3 mb-3 bg-light">
        <div class="row g-3">
          <div class="col-md-6"><input type="text" name="experiences[${expCount}][company_name]" placeholder="Company Name" class="form-control" required></div>
          <div class="col-md-6"><input type="text" name="experiences[${expCount}][title]" placeholder="Job Title" class="form-control"></div>
          <div class="col-md-6"><label>From</label><input type="date" name="experiences[${expCount}][exp_from]" class="form-control"></div>
          <div class="col-md-6"><label>To</label><input type="date" name="experiences[${expCount}][exp_to]" class="form-control"></div>
          <div class="col-12"><textarea name="experiences[${expCount}][exp_description]" rows="2" placeholder="Description" class="form-control"></textarea></div>
          <div class="col-md-10"><label>Company Logo</label><input type="file" name="experiences[${expCount}][exp_logo]" class="form-control"></div>
          <div class="col-md-2 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm removeExp w-100 mt-4">×</button></div>
        </div>
      </div>`;
    container.insertAdjacentHTML('beforeend', newExp);
    expCount++;
  });

  // Add Skill
  document.getElementById('addSkill').addEventListener('click', function () {
    const container = document.getElementById('skillFields');
    const newSkill = `
      <div class="skill-item border rounded p-3 mb-3 bg-light">
        <div class="row g-3">
          <div class="col-md-5"><input type="text" name="skills[${skillCount}][skill_name]" placeholder="Skill name" class="form-control"></div>
          <div class="col-md-5"><input type="number" name="skills[${skillCount}][skill_percent]" placeholder="Percent" class="form-control"></div>
          <div class="col-md-2 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm removeSkill w-100">×</button></div>
        </div>
      </div>`;
    container.insertAdjacentHTML('beforeend', newSkill);
    skillCount++;
  });

  // Remove dynamically
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeEdu')) e.target.closest('.edu-item').remove();
    if (e.target.classList.contains('removeExp')) e.target.closest('.exp-item').remove();
    if (e.target.classList.contains('removeSkill')) e.target.closest('.skill-item').remove();
  });
});
</script>
@endsection
