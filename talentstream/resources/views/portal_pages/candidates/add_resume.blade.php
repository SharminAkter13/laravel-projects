@extends('main')

@section('content')

    <div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Create Resume</h2>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="ti-home"></i> Home</a></li>
                            <li class="current">Resumes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- portal_pages/candidate/add_resume.blade.php --}}

<div class="page-ads box">
    <div class="post-header">
        <p>Already have an account? <a href="/my-account">Click here to login</a></p>
    </div>

    {{-- SUCCESS MESSAGE BLOCK --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Success!</strong> {{ session('success') }}
        </div>
    @endif
    {{-- END SUCCESS MESSAGE BLOCK --}}

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-2">
                    <div class="page-ads box">
                        <div class="post-header">
                            <p>Already have an account? <a href="/my-account">Click here to login</a></p>
                        </div>

                        {{-- Form Setup (Handles create/update based on $resume existence) --}}
                        <form class="form-ad" method="POST"
                            action="{{ isset($resume) ? route('resumes.update', $resume->id) : route('resumes.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if(isset($resume))
                                @method('PUT')
                            @endif

                            {{-- Basic Information (resumes table) --}}
                            <div class="divider"><h3>Basic information</h3></div>
                            <div class="form-group">
                                <label class="control-label" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $resume->name ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your@domain.com" value="{{ $resume->email ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="profession_title">Profession Title</label>
                                <input type="text" class="form-control" name="profession_title" id="profession_title" placeholder="Headline (e.g. Front-end developer)" value="{{ $resume->profession_title ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="location">Location</label>
                                <input type="text" class="form-control" name="location" id="location" placeholder="Location, e.g" value="{{ $resume->location ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="web">Web</label>
                                <input type="url" class="form-control" name="web" id="web" placeholder="Website address" value="{{ $resume->web ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="pre_hour">Pre Hour</label>
                                <input type="text" class="form-control" name="pre_hour" id="pre_hour" placeholder="Salary, e.g. 85" value="{{ $resume->pre_hour ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="age">Age</label>
                                <input type="number" class="form-control" name="age" id="age" placeholder="Years old" value="{{ $resume->age ?? '' }}">
                            </div>
                            <div class="form-group">
                                <div class="button-group">
                                    <div class="action-buttons">
                                        <div class="upload-button">
                                            <button type="button" class="btn btn-common">Choose a cover image</button>
                                            <input name="cover_image" id="cover_img_file" type="file">
                                        </div>
                                    </div>
                                </div>
                                @if(isset($resume) && $resume->cover_image)
                                    <p>Current Cover Image: **{{ basename($resume->cover_image) }}**</p>
                                @endif
                            </div>

                            <hr>
                            {{-- Education (educations table) --}}
                            <div class="divider"><h3>Education</h3></div>
                            <div id="education-container">
                            @forelse ($resume->educations ?? [] as $education)
                            <div class="education-block" id="education-{{ $loop->index }}">
                                <input type="hidden" name="educations[{{ $loop->index }}][id]" value="{{ $education->id ?? '' }}">
                                <div class="form-group">
                                    <label class="control-label" for="edu_degree_{{ $loop->index }}">Degree</label>
                                    <input type="text" class="form-control" name="educations[{{ $loop->index }}][degree]" id="edu_degree_{{ $loop->index }}" placeholder="Degree, e.g. Bachelor" value="{{ $education->degree ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="edu_field_{{ $loop->index }}">Field of Study</label>
                                    <input type="text" class="form-control" name="educations[{{ $loop->index }}][field_of_study]" id="edu_field_{{ $loop->index }}" placeholder="Major, e.g Computer Science" value="{{ $education->field_of_study ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="edu_school_{{ $loop->index }}">School</label>
                                    <input type="text" class="form-control" name="educations[{{ $loop->index }}][school]" id="edu_school_{{ $loop->index }}" placeholder="School name, e.g. Massachusetts Institute of Technology" value="{{ $education->school ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="edu_from_{{ $loop->index }}">From</label>
                                            <input type="text" class="form-control" name="educations[{{ $loop->index }}][edu_from]" id="edu_from_{{ $loop->index }}" placeholder="e.g 2014" value="{{ $education->edu_from ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label" for="edu_to_{{ $loop->index }}">To</label>
                                            <input type="text" class="form-control" name="educations[{{ $loop->index }}][edu_to]" id="edu_to_{{ $loop->index }}" placeholder="e.g 2018" value="{{ $education->edu_to ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="edu_description_{{ $loop->index }}">Description</label>
                                    <textarea class="form-control" name="educations[{{ $loop->index }}][edu_description]" id="edu_description_{{ $loop->index }}" rows="7">{{ $education->edu_description ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="button-group">
                                        <div class="action-buttons">
                                            <div class="upload-button">
                                                <button type="button" class="btn btn-common">Choose a cover Logo</button>
                                                <input name="educations[{{ $loop->index }}][edu_logo]" type="file">
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($education) && $education->edu_logo)
                                        <p>Current Logo: **{{ basename($education->edu_logo) }}**</p>
                                    @endif
                                </div>
                                <div class="add-post-btn">
                                    <div class="pull-right">
                                        <a href="#" class="btn-delete" data-id="education-{{ $loop->index }}"><i class="ti-trash"></i> Delete This Education</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @empty
                            {{-- Initial empty education block (Index 0) --}}
                            <div class="education-block" id="education-0">
                                <input type="hidden" name="educations[0][id]" value="">
                                <div class="form-group">
                                    <label class="control-label" for="edu_degree_0">Degree</label>
                                    <input type="text" class="form-control" name="educations[0][degree]" id="edu_degree_0" placeholder="Degree, e.g. Bachelor" value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="edu_field_0">Field of Study</label>
                                    <input type="text" class="form-control" name="educations[0][field_of_study]" id="edu_field_0" placeholder="Major, e.g Computer Science" value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="edu_school_0">School</label>
                                    <input type="text" class="form-control" name="educations[0][school]" id="edu_school_0" placeholder="School name, e.g. Massachusetts Institute of Technology" value="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="edu_from_0">From</label>
                                            <input type="text" class="form-control" name="educations[0][edu_from]" id="edu_from_0" placeholder="e.g 2014" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label" for="edu_to_0">To</label>
                                            <input type="text" class="form-control" name="educations[0][edu_to]" id="edu_to_0" placeholder="e.g 2018" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="edu_description_0">Description</label>
                                    <textarea class="form-control" name="educations[0][edu_description]" id="edu_description_0" rows="7"></textarea>
                                </div>
                               
                                <div class="add-post-btn">
                                    <div class="pull-right">
                                        <a href="#" class="btn-delete" data-id="education-0"><i class="ti-trash"></i> Delete This Education</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @endforelse
                            </div>
                            {{-- Button to add new education --}}
                            <div class="add-post-btn">
                                <div class="pull-left">
                                    <a href="#" class="btn-added" id="add-education-btn"><i class="ti-plus"></i> Add New Education</a>
                                </div>
                            </div>
                            <hr>


                            {{-- Work Experience (experiences table) --}}
                            <div class="divider"><h3>Work Experience</h3></div>
                            <div id="experience-container">
                            @forelse ($resume->experiences ?? [] as $experience)
                            <div class="experience-block" id="experience-{{ $loop->index }}">
                                <input type="hidden" name="experiences[{{ $loop->index }}][id]" value="{{ $experience->id ?? '' }}">
                                <div class="form-group">
                                    <label class="control-label" for="exp_company_{{ $loop->index }}">Company Name</label>
                                    <input type="text" class="form-control" name="experiences[{{ $loop->index }}][company_name]" id="exp_company_{{ $loop->index }}" placeholder="Company name" value="{{ $experience->company_name ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="exp_title_{{ $loop->index }}">Title</label>
                                    <input type="text" class="form-control" name="experiences[{{ $loop->index }}][title]" id="exp_title_{{ $loop->index }}" placeholder="e.g UI/UX Researcher" value="{{ $experience->title ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="exp_from_{{ $loop->index }}">Date From</label>
                                            <input type="text" class="form-control" name="experiences[{{ $loop->index }}][exp_from]" id="exp_from_{{ $loop->index }}" placeholder="e.g 2014" value="{{ $experience->exp_from ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label" for="exp_to_{{ $loop->index }}">Date To</label>
                                            <input type="text" class="form-control" name="experiences[{{ $loop->index }}][exp_to]" id="exp_to_{{ $loop->index }}" placeholder="e.g 2018" value="{{ $experience->exp_to ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <div class="description-editor">
                                        {{-- Textarea for Summernote --}}
                                        <textarea name="experiences[{{ $loop->index }}][exp_description]" id="summernote_{{ $loop->index }}" rows="7">{{ $experience->exp_description ?? '' }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="add-post-btn">
                                    <div class="pull-right">
                                        <a href="#" class="btn-delete" data-id="experience-{{ $loop->index }}"><i class="ti-trash"></i> Delete This Experience</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @empty
                            {{-- Initial empty experience block (Index 0) --}}
                            <div class="experience-block" id="experience-0">
                                <input type="hidden" name="experiences[0][id]" value="">
                                <div class="form-group">
                                    <label class="control-label" for="exp_company_0">Company Name</label>
                                    <input type="text" class="form-control" name="experiences[0][company_name]" id="exp_company_0" placeholder="Company name" value="">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="exp_title_0">Title</label>
                                    <input type="text" class="form-control" name="experiences[0][title]" id="exp_title_0" placeholder="e.g UI/UX Researcher" value="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="exp_from_0">Date From</label>
                                            <input type="text" class="form-control" name="experiences[0][exp_from]" id="exp_from_0" placeholder="e.g 2014" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label" for="exp_to_0">Date To</label>
                                            <input type="text" class="form-control" name="experiences[0][exp_to]" id="exp_to_0" placeholder="e.g 2018" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <div class="description-editor">
                                        {{-- Textarea for Summernote --}}
                                        <textarea name="experiences[0][exp_description]" id="summernote_0" rows="7"></textarea>
                                    </div>
                                </div>
                               
                                <div class="add-post-btn">
                                    <div class="pull-right">
                                        <a href="#" class="btn-delete" data-id="experience-0"><i class="ti-trash"></i> Delete This Experience</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @endforelse
                            </div>
                            {{-- Button to add new experience --}}
                            <div class="add-post-btn">
                                <div class="pull-left">
                                    <a href="#" class="btn-added" id="add-experience-btn"><i class="ti-plus"></i> Add New Experience</a>
                                </div>
                            </div>
                            <hr>


                            {{-- Skills (skills table) --}}
                            <div class="divider"><h3>Skills</h3></div>
                            <div id="skill-container">
                            @forelse ($resume->skills ?? [] as $skill)
                            <div class="skill-block" id="skill-{{ $loop->index }}">
                                <input type="hidden" name="skills[{{ $loop->index }}][id]" value="{{ $skill->id ?? '' }}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="skill_name_{{ $loop->index }}">Skill Name</label>
                                            <input class="form-control" name="skills[{{ $loop->index }}][skill_name]" id="skill_name_{{ $loop->index }}" placeholder="Skill name, e.g. HTML" type="text" value="{{ $skill->skill_name ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label" for="skill_percent_{{ $loop->index }}">% (1-100)</label>
                                            <input class="form-control" name="skills[{{ $loop->index }}][skill_percent]" id="skill_percent_{{ $loop->index }}" placeholder="Skill proficiency, e.g. 90" type="number" min="1" max="100" value="{{ $skill->skill_percent ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="add-post-btn">
                                    <div class="pull-right">
                                        <a href="#" class="btn-delete" data-id="skill-{{ $loop->index }}"><i class="ti-trash"></i> Delete This</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @empty
                            {{-- Initial empty skill block (Index 0) --}}
                            <div class="skill-block" id="skill-0">
                                <input type="hidden" name="skills[0][id]" value="">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="skill_name_0">Skill Name</label>
                                            <input class="form-control" name="skills[0][skill_name]" id="skill_name_0" placeholder="Skill name, e.g. HTML" type="text" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label" for="skill_percent_0">% (1-100)</label>
                                            <input class="form-control" name="skills[0][skill_percent]" id="skill_percent_0" placeholder="Skill proficiency, e.g. 90" type="number" min="1" max="100" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="add-post-btn">
                                    <div class="pull-right">
                                        <a href="#" class="btn-delete" data-id="skill-0"><i class="ti-trash"></i> Delete This</a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            @endforelse
                            </div>
                            {{-- Button to add new skill --}}
                            <div class="add-post-btn">
                                <div class="pull-left">
                                    <a href="#" class="btn-added" id="add-skill-btn"><i class="ti-plus"></i> Add New Skills</a>
                                </div>
                            </div>
                            <hr>

                            <button type="submit" class="btn btn-common">Save Resume</button>
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
        // --- Summernote Initialization ---
        // Initialize Summernote for all experience descriptions
        $('[id^="summernote_"]').each(function() {
             $(this).summernote({
                height: 250,
                focus: false
            });
        });

        // --- Dynamic Field Templates and Cloning ---

        /**
         * Clones the last block of a given type, updates its indices, clears inputs, 
         * and appends it to the container.
         */
        function createNewBlock(containerId, blockClass) {
            let container = $(`#${containerId}`);
            // Count current blocks to determine the new index
            let currentIndex = container.children(`.${blockClass}`).length;
            
            // Clone the structure of the last block (used as the template)
            let templateBlock = container.children(`.${blockClass}`).last();
            let newBlock = templateBlock.clone(false); // `false` prevents event handlers from being copied
            
            // Update IDs and Names for the new index
            newBlock.attr('id', `${blockClass}-${currentIndex}`);
            
            // 1. Update all attributes containing the previous index
            newBlock.find('*').each(function() {
                let element = $(this);
                let oldIndex = currentIndex - 1; 

                // Replace index in name attribute (e.g., educations[0] -> educations[1])
                let nameAttr = element.attr('name');
                if (nameAttr && nameAttr.includes(`[${oldIndex}]`)) {
                    element.attr('name', nameAttr.replace(`[${oldIndex}]`, `[${currentIndex}]`));
                }

                // Replace index in id and for attributes (e.g., edu_degree_0 -> edu_degree_1)
                let idAttr = element.attr('id');
                if (idAttr && idAttr.includes(`_${oldIndex}`)) {
                    element.attr('id', idAttr.replace(`_${oldIndex}`, `_${currentIndex}`));
                }
                
                let forAttr = element.attr('for');
                if (forAttr && forAttr.includes(`_${oldIndex}`)) {
                    element.attr('for', forAttr.replace(`_${oldIndex}`, `_${currentIndex}`));
                }

                // Update delete button data-id
                if (element.hasClass('btn-delete')) {
                    element.attr('data-id', `${blockClass}-${currentIndex}`);
                }
                
                // Clear hidden ID field to treat it as a new record
                if (element.attr('name') && element.attr('name').endsWith('[id]')) {
                    element.val('');
                }
            });

            // 2. Clear visible Input Values
            newBlock.find('input[type="text"], input[type="number"]').val('');
            newBlock.find('textarea').val('');
            newBlock.find('input[type="file"]').val('');
            newBlock.find('p').remove(); // Remove existing logo/image message
            
            // 3. Handle Summernote for Experience blocks
            if (blockClass === 'experience-block') {
                // Remove the old Summernote instance (editor divs) and re-show the textarea
                newBlock.find('.note-editor').remove();
                let newTextarea = newBlock.find('textarea[name^="experiences"]').attr('id', `summernote_${currentIndex}`).show();
                
                // Re-initialize Summernote
                newTextarea.summernote({
                    height: 250,
                    focus: true
                });
            }
            
            // 4. Append the new block
            container.append(newBlock);
        }
        
        // Add Button Handlers
        $('#add-education-btn').on('click', function(e) {
            e.preventDefault();
            createNewBlock('education-container', 'education-block');
        });

        $('#add-experience-btn').on('click', function(e) {
            e.preventDefault();
            createNewBlock('experience-container', 'experience-block');
        });

        $('#add-skill-btn').on('click', function(e) {
            e.preventDefault();
            createNewBlock('skill-container', 'skill-block');
        });

        // Delete Block Logic (Uses event delegation for dynamically added elements)
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let blockId = $(this).data('id');
            // Remove the block
            $('#' + blockId).remove();
        });
    });
</script>
@endpush