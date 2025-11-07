@extends('main')

@section('content')
    <!-- Redirect if not logged in -->
    @guest
        <div class="alert alert-warning text-center mt-5">
            You must <a href="{{ route('login') }}">login</a> to create a resume.
        </div>
        @php return; @endphp
    @endguest

    <!-- Page Header Start -->
    <div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
        <div class="container">
            <div class="row">         
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Create Resume</h2>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('portal.home') }}"><i class="ti-home"></i> Home</a></li>
                            <li class="current">Resumes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->   

    <section id="content">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="page-ads box p-4">

              {{-- ✅ Success message --}}
              @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>🎉 Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              @endif

              <form class="form-ad" action="{{ route('resume.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="divider"><h3>Basic information</h3></div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                </div>

                <div class="form-group">
                    <label>Profession Title</label>
                    <input type="text" name="profession_title" class="form-control" placeholder="e.g. Front-end developer">
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" placeholder="e.g. Dhaka, Bangladesh">
                </div>

                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="web" class="form-control" placeholder="Website address">
                </div>

                <div class="form-group">
                    <label>Hourly Rate</label>
                    <input type="text" name="pre_hour" class="form-control" placeholder="e.g. 85">
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" placeholder="e.g. 25">
                </div>

                <div class="form-group">
                    <label>Cover Image</label>
                    <input type="file" name="cover_image" class="form-control file-input">
                    <!-- ✅ Added -->
                    <small class="text-muted file-name"></small>
                </div>

                {{-- Education Section --}}
                <div class="divider"><h3>Education</h3></div>

                <div id="education-section">
                    <div class="education-group mb-4 border p-3 rounded">
                        <div class="form-group">
                            <label>Degree</label>
                            <input type="text" name="educations[0][degree]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Field of Study</label>
                            <input type="text" name="educations[0][field_of_study]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>School</label>
                            <input type="text" name="educations[0][school]" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>From</label>
                                <input type="text" name="educations[0][edu_from]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>To</label>
                                <input type="text" name="educations[0][edu_to]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="educations[0][edu_description]" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="educations[0][edu_logo]" class="form-control file-input">
                            <!-- ✅ Added -->
                            <small class="text-muted file-name"></small>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-education" class="btn btn-sm btn-primary mb-3">
                    <i class="ti-plus"></i> Add New Education
                </button>

                {{-- Experience Section --}}
                <div class="divider"><h3>Work Experience</h3></div>

                <div id="experience-section">
                    <div class="experience-group mb-4 border p-3 rounded">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="experiences[0][company_name]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="experiences[0][title]" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>From</label>
                                <input type="text" name="experiences[0][exp_from]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>To</label>
                                <input type="text" name="experiences[0][exp_to]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label>Description</label>
                            <textarea name="experiences[0][exp_description]" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="experiences[0][exp_logo]" class="form-control file-input">
                            <!-- ✅ Added -->
                            <small class="text-muted file-name"></small>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-experience" class="btn btn-sm btn-primary mb-3">
                    <i class="ti-plus"></i> Add New Experience
                </button>

                {{-- Skills Section --}}
                <div class="divider"><h3>Skills</h3></div>
                <div id="skills-section">
                    <div class="skill-group row mb-2">
                        <div class="col-md-6">
                            <input class="form-control" name="skills[0][skill_name]" placeholder="Skill name, e.g. HTML">
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" name="skills[0][skill_percent]" placeholder="Skill proficiency, e.g. 90">
                        </div>
                    </div>
                </div>
                <button type="button" id="add-skill" class="btn btn-sm btn-primary mb-4">
                    <i class="ti-plus"></i> Add New Skill
                </button>

                <div class="text-center">
                    <button type="submit" class="btn btn-common">Save Resume</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
<script>
  $(function() {
    let eduIndex = 1, expIndex = 1, skillIndex = 1;

    // ✅ File name display
    $(document).on('change', '.file-input', function() {
        const fileName = this.files.length ? this.files[0].name : 'No file selected';
        $(this).siblings('.file-name').text('📁 ' + fileName);
    });

    $('#add-education').click(function() {
      let html = $('#education-section .education-group:first').clone();
      html.find('input, textarea, small').each(function() {
        if ($(this).is('input, textarea')) {
            let name = $(this).attr('name').replace('[0]', '['+eduIndex+']');
            $(this).attr('name', name).val('');
        } else {
            $(this).text(''); // clear file name label
        }
      });
      $('#education-section').append(html);
      eduIndex++;
    });

    $('#add-experience').click(function() {
      let html = $('#experience-section .experience-group:first').clone();
      html.find('input, textarea, small').each(function() {
        if ($(this).is('input, textarea')) {
            let name = $(this).attr('name').replace('[0]', '['+expIndex+']');
            $(this).attr('name', name).val('');
        } else {
            $(this).text('');
        }
      });
      $('#experience-section').append(html);
      expIndex++;
    });

    $('#add-skill').click(function() {
      let html = $('#skills-section .skill-group:first').clone();
      html.find('input').each(function() {
        let name = $(this).attr('name').replace('[0]', '['+skillIndex+']');
        $(this).attr('name', name).val('');
      });
      $('#skills-section').append(html);
      skillIndex++;
    });
  });
</script>
@endpush
