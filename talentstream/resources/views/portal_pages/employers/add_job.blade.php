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
                        <li><a href="{{ url('/') }}"><i class="ti-home"></i> Home</a></li>
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

                <div class="page-ads box">
                    <form class="form-ad" method="POST" action="{{ route('portal.job.store') }}" enctype="multipart/form-data">
                        @csrf

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
                            <select name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="Finance">Finance</option>
                                <option value="IT & Engineering">IT & Engineering</option>
                                <option value="Education/Training">Education/Training</option>
                                <option value="Art/Design">Art/Design</option>
                                <option value="Sale/Marketing">Sale/Marketing</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Science">Science</option>                              
                                <option value="Food Services">Food Services</option>
                            </select>
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Job Tags <span>(optional)</span></label>
                            <input type="text" name="tags" class="form-control" placeholder="e.g. PHP, Social Media, Management">
                            <p class="note">Comma separate tags for skills or technologies.</p>
                        </div>  

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea id="summernote" name="description" class="form-control" rows="10" required>
                                Your Description Here...
                            </textarea>
                        </div>                

                        <div class="form-group">
                            <label class="control-label">Application email / URL</label>
                            <input type="text" name="application_email" class="form-control" placeholder="Enter an email address or website URL" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Closing Date <span>(optional)</span></label>
                            <input type="date" name="closing_date" class="form-control">
                        </div> 

                        <div class="divider"><h3>Company Details</h3></div>

                        <div class="form-group">
                            <label class="control-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" 
                                   value="{{ $company->name ?? '' }}" required>
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Website <span>(optional)</span></label>
                            <input type="url" name="website" class="form-control" value="{{ $company->website ?? '' }}">
                        </div> 

                        <div class="form-group">
                            <label class="control-label">Phone <span>(optional)</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ $company->contact_phone ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Address <span>(optional)</span></label>
                            <input type="text" name="address" class="form-control" value="{{ $company->address ?? '' }}">
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
