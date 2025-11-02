@extends('main')
@section('content')

<!-- Page Header Start -->
<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
    <div class="container">
        <div class="row">         
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Post A Job</h2>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="ti-home"></i> Home</a></li>
                        <li class="current">Post A Job</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->    

<!-- Content section Start --> 
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9 col-md-offset-2">
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <fieldset>
                    <label>Have an account?</label>
                    <div class="field account-sign-in">
                        <p>
                            <a class="btn btn-common btn-sm" href="{{ route('login') }}"><i class="ti-key"></i> Sign in</a>
                        </p>                      
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                            If you don’t have an account you can create one below by entering your email address. A password will be automatically emailed to you.        
                        </div>
                    </div>
                </fieldset>

                <div class="page-ads box">
                    <form class="form-ad" method="POST" action="{{ route('portal.job.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="control-label">Your Email</label>
                            <input type="email" name="user_email" class="form-control" placeholder="mail@example.com" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Job Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Job Title" required>
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Location <span>(optional)</span></label>
                            <input type="text" name="location" class="form-control" placeholder="e.g. London">
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <div class="search-category-container">
                                <label class="styled-select">
                                    <select name="category" class="dropdown-product selectpicker" required>
                                        <option value="">All Categories</option>
                                        <option value="Finance">Finance</option>
                                        <option value="IT & Engineering">IT & Engineering</option>
                                        <option value="Education/Training">Education/Training</option>
                                        <option value="Art/Design">Art/Design</option>
                                        <option value="Sale/Marketing">Sale/Marketing</option>
                                        <option value="Healthcare">Healthcare</option>
                                        <option value="Science">Science</option>                              
                                        <option value="Food Services">Food Services</option>
                                    </select>
                                </label>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Job Tags <span>(optional)</span></label>
                            <input type="text" name="tags" class="form-control" placeholder="e.g. PHP, Social Media, Management">
                            <p class="note">Comma separate tags, such as required skills or technologies, for this job.</p>
                        </div>  

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea id="summernote" name="description" class="form-control" rows="10" required>
                                Your Description Here .....
                            </textarea>
                        </div>                

                        <div class="form-group">
                            <label class="control-label">Application email / URL</label>
                            <input type="text" name="application_email" class="form-control" placeholder="Enter an email address or website URL" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Closing Date <span>(optional)</span></label>
                            <input type="date" name="closing_date" class="form-control">
                            <p class="note">Deadline for new applicants.</p>
                        </div> 

                        <div class="divider"><h3>Company Details</h3></div>

                        <div class="form-group">
                            <label class="control-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" placeholder="Enter the name of the company" required>
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Website <span>(optional)</span></label>
                            <input type="url" name="website" class="form-control" placeholder="http://">
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Tagline <span>(optional)</span></label>
                            <input type="text" name="tagline" class="form-control" placeholder="Briefly describe your company">
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Company Cover Image <span>(optional)</span></label>
                            <input type="file" name="cover_img_file" class="form-control" id="cover_img_file">
                        </div> 

                        <button type="submit" class="btn btn-common">Submit your job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Content section End -->         

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    });
</script>
@endpush
