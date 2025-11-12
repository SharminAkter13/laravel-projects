@extends('main')

@section('content')

@guest
    <div class="alert alert-warning text-center mt-5">
        You must <a href="{{ route('login') }}">login</a> to create a resume.
    </div>
    @php return; @endphp
@endguest

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

<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="page-ads box p-4">

                    {{-- ✅ Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>🎉 Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form class="form-ad" action="{{ route('resume.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ✅ Basic Information --}}
                        <div class="divider"><h3>Basic Information</h3></div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', Auth::user()->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', Auth::user()->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Profession Title</label>
                            <input type="text" name="profession_title" class="form-control" placeholder="e.g. Front-end Developer">
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
                        <label class="mb-2 font-weight-bold">Cover Image</label>
                        <div class="row border rounded p-3" style="height: 130px; border: 2px solid gray;margin:10px;">

                            <!-- Left column: Upload field -->
                            <div class="col-md-4  text-white rounded-left d-flex flex-column justify-content-center align-items-center" style="height: 75%; margin-left:20px;text-align: center;">
                            <label class="form-label font-weight-semibold mb-2 "  style="text-align: center; font-size:14pt;margin-top:40px">Upload Image</label>
                            <input type="file" name="cover_image" class="form-control file-input bg-light text-dark">
                            </div>

                            <!-- Right column: Preview + filename -->
                            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" style="height: 100%; padding: 10px;">
                            <img src="" alt="Preview" class="img-thumbnail preview-image mb-2"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            <small class="text-muted file-name">No file chosen</small>
                            </div>

                        </div>
                        </div>

                        {{-- ✅ Education Section --}}
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
                                        <label>From Year</label>
                                        <input type="number" name="educations[0][edu_from]" class="form-control"
                                            placeholder="e.g. 2018" min="1950" max="{{ date('Y') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>To Year</label>
                                        <input type="number" name="educations[0][edu_to]" class="form-control"
                                            placeholder="e.g. 2022" min="1950" max="{{ date('Y') + 5 }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="educations[0][edu_description]" class="form-control" rows="3"></textarea>
                                </div>
                            
                                <button type="button" class="btn btn-danger btn-sm remove-group mt-2">Remove Education</button>
                            </div>
                        </div>
                        <button type="button" id="add-education" class="btn btn-sm btn-primary mb-3">
                            <i class="ti-plus"></i> Add New Education
                        </button>

                       {{-- ✅ Work Experience --}}
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
                                        <label>From Date</label>
                                        <input type="date" name="experiences[0][exp_from]" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>To Date</label>
                                        <input type="date" name="experiences[0][exp_to]" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label>Description</label>
                                    <textarea name="experiences[0][exp_description]" class="form-control" rows="3"></textarea>
                                </div>
                            
                                <button type="button" class="btn btn-danger btn-sm remove-group mt-2">Remove Experience</button>
                            </div>
                        </div>
                        <button type="button" id="add-experience" class="btn btn-sm btn-primary mb-3">
                            <i class="ti-plus"></i> Add New Experience
                        </button>


                        {{-- ✅ Skills Section --}}
                        <div class="divider"><h3>Skills</h3></div>
                        <div id="skills-section">
                            <div class="skill-group row mb-2 align-items-center">
                                <div class="col-md-5">
                                    <input class="form-control" name="skills[0][skill_name]" placeholder="Skill name, e.g. HTML">
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" name="skills[0][skill_percent]" placeholder="Skill proficiency, e.g. 90">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-group">Remove</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-skill" class="btn btn-sm btn-primary m-3">
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
    function reIndexGroups(sectionId, prefix) {
        $('#' + sectionId).children().each(function(index) {
            $(this).find('input, textarea').each(function() {
                let name = $(this).attr('name');
                if (name && name.startsWith(prefix)) {
                    $(this).attr('name', name.replace(/\[\d+\]/, '[' + index + ']'));
                }
            });
        });
    }

    // ✅ Show selected filename
    $(document).on('change', '.file-input', function() {
        const name = this.files.length ? this.files[0].name : 'No file selected';
        $(this).siblings('.file-name').text('📁 ' + name);
    });

    // ✅ Remove item
    $(document).on('click', '.remove-group', function() {
        const group = $(this).closest('.education-group, .experience-group, .skill-group');
        const section = group.parent();
        if (section.children().length > 1) {
            group.remove();
            const id = section.attr('id');
            if (id === 'education-section') reIndexGroups(id, 'educations');
            else if (id === 'experience-section') reIndexGroups(id, 'experiences');
            else if (id === 'skills-section') reIndexGroups(id, 'skills');
        } else {
            alert('You must keep at least one entry.');
            group.find('input, textarea').val('');
            group.find('.file-name').text('');
        }
    });

    $(document).on('change', '.file-input', function () {
    const file = this.files[0];
    const $row = $(this).closest('.row');
    const $fileName = $row.find('.file-name');
    const $preview = $row.find('.preview-image');

    if (file) {
        $fileName.text(file.name);
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                $preview.attr('src', e.target.result).removeClass('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            $preview.addClass('d-none');
        }
    } else {
        $fileName.text('No file chosen');
        $preview.addClass('d-none');
    }
});

    // ✅ Add Education
    $('#add-education').click(function() {
        let index = $('#education-section .education-group').length;
        let clone = $('#education-section .education-group:first').clone();
        clone.find('input, textarea').val('');
        clone.find('.file-name').text('');
        clone.find('input, textarea').each(function() {
            $(this).attr('name', $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']'));
        });
        $('#education-section').append(clone);
    });

    // ✅ Add Experience
    $('#add-experience').click(function() {
        let index = $('#experience-section .experience-group').length;
        let clone = $('#experience-section .experience-group:first').clone();
        clone.find('input, textarea').val('');
        clone.find('.file-name').text('');
        clone.find('input, textarea').each(function() {
            $(this).attr('name', $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']'));
        });
        $('#experience-section').append(clone);
    });

    // ✅ Add Skill
    $('#add-skill').click(function() {
        let index = $('#skills-section .skill-group').length;
        let clone = $('#skills-section .skill-group:first').clone();
        clone.find('input').val('');
        clone.find('input').each(function() {
            $(this).attr('name', $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']'));
        });
        $('#skills-section').append(clone);
    });
});
</script>
@endpush
