@extends('main')
@section('content')

<!-- Page Header -->
<div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
  <div class="container">
    <div class="row">         
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Browse Categories</h2>
          <ol class="breadcrumb">
            <li><a href="{{ route('portal.home') }}"><i class="ti-home"></i> Home</a></li>
            <li class="current">Categories</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Category Section -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Browse Categories</h2>  
    <div class="row">
      @forelse($categories as $category)
        <div class="col-md-3 col-sm-6 col-xs-12 f-category mb-3">
          <a href="#">
            <div class="icon">
              <i class="{{ $category->icon ?? 'ti-briefcase' }}"></i>
            </div>
            <h3>{{ $category->name }}</h3>
            <p>{{ $category->job_count }} jobs</p>
          </a>
        </div>
      @empty
        <div class="col-md-12 text-center">
          <p>No categories found.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

@endsection
