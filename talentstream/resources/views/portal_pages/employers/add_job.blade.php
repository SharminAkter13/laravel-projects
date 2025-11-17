@extends('main')

@section('content')

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

                        <!-- Job Title -->
                        <div class="form-group">
                            <label class="control-label">Job Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <!-- Job Location -->
                        <div class="form-group">
                            <label class="control-label">Location</label>
                            <select name="job_location_id" class="form-control" required>
                                <option value="">Select Location</option>
                                @foreach($jobLocations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->city	 }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Job Type -->
                        <div class="form-group">
                            <label class="control-label">Job Type</label>
                            <select name="job_type_id" class="form-control" required>
                                <option value="">Select Job Type</option>
                                @foreach($jobTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tags -->
                        <div class="form-group">
                            <label class="control-label">Job Tags (optional)</label>
                            <input type="text" name="tags" class="form-control" placeholder="e.g. PHP, Manager">
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea id="summernote" name="description" class="form-control" rows="10" required>
                            </textarea>
                        </div>

                        <!-- Apply Email / URL -->
                        <div class="form-group">
                            <label class="control-label">Application email / URL</label>
                            <input type="text" name="application_email" class="form-control">
                            <input type="text" name="application_url" class="form-control mt-2">
                        </div>

                        <!-- Closing Date -->
                        <div class="form-group">
                            <label class="control-label">Closing Date</label>
                            <input type="date" name="closing_date" class="form-control">
                        </div>

                        <div class="divider"><h3>Company Details</h3></div>

                        <!-- Company Name -->
                        <div class="form-group">
                            <label class="control-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" value="{{ $company->name ?? '' }}" required>
                        </div>

                        <!-- Website -->
                        <div class="form-group">
                            <label class="control-label">Website</label>
                            <input type="url" name="website" class="form-control" value="{{ $company->website ?? '' }}">
                        </div>

                        <!-- Tagline -->
                        <div class="form-group">
                            <label class="control-label">Tagline (optional)</label>
                            <input type="text" name="tagline" class="form-control" value="{{ $company->tagline ?? '' }}">
                        </div>

                        <!-- Cover Image -->
                        <div class="form-group">
                            <label class="control-label">Company Cover Image</label>
                            <input type="file" name="cover_img_file" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-common">Submit your job</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 250,
        focus: true
    });
});
</script>
@endpush
