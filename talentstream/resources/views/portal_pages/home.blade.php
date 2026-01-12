@extends('main')
@section('content')

<div class="search-container mt-5 p-8" style="position: relative; background-image: url('{{ asset('portal/assets/img/bg/bg-intro.jpg') }}');background-size:cover;background-position:center;background-repeat:no-repeat;">
       <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.51);"></div>
     
        <div class="container" style="position: relative; z-index: 2;">

          <div class="row">
            <div class="col-md-12">
              <h1 style="color:white!important">Find the job that fits your life</h1><br>
              <h2>More than <strong>12,000</strong> jobs are waiting to Kickstart your career!</h2>
              <div class="content">
                <form method="" action="#">
                  <div class="row">
                    <div class="col-md-4 col-sm-6">
                      <div class="form-group">
                        <input class="form-control" type="text" placeholder="job title / keywords / company name">
                        <i class="ti-time"></i>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="form-group">
                        <input class="form-control" type="email" placeholder="city / province / zip code">
                        <i class="ti-location-pin"></i>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="search-category-container">
                        <label class="styled-select">
                          <select class="dropdown-product selectpicker">
                            <option>All Categories</option>
                            <option>Finance</option>
                            <option>IT & Engineering</option>
                            <option>Education/Training</option>
                            <option>Art/Design</option>
                            <option>Sale/Markting</option>
                            <option>Healthcare</option>
                            <option>Science</option>
                            <option>Food Services</option>
                          </select>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-1 col-sm-6">
                      <button type="button" class="btn btn-search-icon"><i class="ti-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="popular-jobs">
                <b style="color:white!important">Popular Keywords: </b>
                <a href="#">Web Design</a>
                <a href="#">Manager</a>
                <a href="#">Programming</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <!-- end intro section -->

    <!-- Service  Section -->
    <section id="service-main" class="section" >
      <!-- Container Starts -->
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div class="service-item">
              <div class="icon-wrapper">
                <i class="ti-search">
                </i>
              </div>
              <h2>
                Search Miloins of jobs
              </h2>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis eligendi consequuntur assumenda
                perferendis natus dolorem facere mollitia eius.
              </p>
            </div>
            <!-- Service-Block-1 Item Ends -->
          </div>

          <div class="col-sm-6 col-md-4">
            <!-- Service-Block-1 Item Starts -->
            <div class="service-item">
              <div class="icon-wrapper">
                <i class="ti-world">
                </i>
              </div>
              <h2>
                Location Base Search
              </h2>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis eligendi consequuntur assumenda
                perferendis natus dolorem facere mollitia eius.
              </p>
            </div>
          </div>

          <div class="col-sm-6 col-md-4">
            <div class="service-item">
              <div class="icon-wrapper">
                <i class="ti-stats-up">
                </i>
              </div>
              <h2>
                Top Careers
              </h2>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis eligendi consequuntur assumenda
                perferendis natus dolorem facere mollitia eius.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Service Main Section Ends -->

    <!-- Find Job Section Start -->
    <section class="find-job section">
      <div class="container">
        <h2 class="section-title">Hot Jobs</h2>
        <div class="row p-5">
          <div class="col-md-12">
            @foreach($hotJobs as $job)
              <div class="job-list d-flex align-items-start flex-wrap border rounded p-3 mb-4">
                <div class="thumb me-3">
                  <a href="{{ route('jobs.show', $job->id) }}">
                   <img src="{{ $job->cover_image ? asset($job->cover_image) : asset('images/default-job.png') }}" 
     class="job-thumb">
                  </a>
                </div>

                <div class="job-list-content flex-grow-1">
                  <h4>
                    <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                    <span class="full-time">Full-Time</span>
                  </h4>

                  <p>{{ Str::limit($job->description, 120) }}</p>

                  <div class="job-tag">
                    <div class="meta-tag">
                      <span><i class="ti-location-pin"></i> {{ $job->location ?? 'Location not specified' }}</span>

                      <span>
                        <i class="ti-time"></i>
                        @if($job->closing_date)
                          @if(\Carbon\Carbon::parse($job->closing_date)->isPast())
                            <strong class="text-danger">Expired</strong>
                          @else
                            Expires on {{ \Carbon\Carbon::parse($job->closing_date)->format('M d, Y') }}
                          @endif
                        @else
                          No closing date
                        @endif
                      </span>
                    </div>
                  </div>
                </div>

                <div class="apply-button-section text-end mt-3 mt-md-0">
                  <button 
                    type="button" 
                    class="btn-favorite @if($job->is_bookmarked) bookmarked @endif"
                    data-job-id="{{ $job->id }}"
                  >
                    <i class="ti-heart"></i>
                  </button>
                  <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-danger apply-job-btn"> See Details</a>
                  <a href="{{ route('applications.create', $job->id) }}" class="btn btn-danger apply-job-btn">APPLY JOB</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <!-- Find Job Section End -->

    <!-- Category Section Start -->
      <section class="category section">
          <div class="container">
              <h2 class="section-title">Browse Categories</h2>
              <div class="row">
                  <div class="col-md-12">
                      @foreach($categories as $cat)
                      <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                          <a href="#">
                              <div class="icon">
                                  @if($cat->image_path)
                                      <img src="{{ asset('storage/' . $cat->image_path) }}" alt="{{ $cat->name }}" width="50">
                                  @else
                                      <img src="{{ asset('images/default-icon.png') }}" alt="No Image" width="50"> 
                                  @endif
                              </div>
                              <h3>{{ strtoupper($cat->name) }}</h3> 
                              <p>{{ \App\Models\Job::where('category_id', $cat->id)->count() }} jobs</p>
                          </a>
                      </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </section>  
        
      <!-- Category Section End -->

    <!-- Featured Jobs Section Start -->
    <section class="featured-jobs section">
      <div class="container">
        <h2 class="section-title">
          Featured Jobs
        </h2>
        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="featured-item">
              <div class="featured-wrap">
                <div class="featured-inner">
                  <figure class="item-thumb">
                    <a class="hover-effect" href="job-page.html">
                      <img src="portal/assets/img/features/img-1.jpg" alt="">
                    </a>
                  </figure>
                  <div class="item-body">
                    <h3 class="job-title"><a href="job-page.html">Graphic Designer</a></h3>
                    <div class="adderess"><i class="ti-location-pin"></i> Dallas, United States</div>
                  </div>
                </div>
              </div>
              <div class="item-foot">
                <span><i class="ti-calendar"></i> 4 months ago</span>
                <span><i class="ti-time"></i> Full Time</span>
                <div class="view-iocn">
                  <a href="job-page.html"><i class="ti-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="featured-item">
              <div class="featured-wrap">
                <div class="featured-inner">
                  <figure class="item-thumb">
                    <a class="hover-effect" href="job-page.html">
                      <img src="portal/assets/img/features/img-2.jpg" alt="">
                    </a>
                  </figure>
                  <div class="item-body">
                    <h3 class="job-title"><a href="job-page.html">Software Engineer</a></h3>
                    <div class="adderess"><i class="ti-location-pin"></i> Delaware, United States</div>
                  </div>
                </div>
              </div>
              <div class="item-foot">
                <span><i class="ti-calendar"></i> 5 months ago</span>
                <span><i class="ti-time"></i> Part Time</span>
                <div class="view-iocn">
                  <a href="job-page.html"><i class="ti-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="featured-item">
              <div class="featured-wrap">
                <div class="featured-inner">
                  <figure class="item-thumb">
                    <a class="hover-effect" href="job-page.html">
                      <img src="portal/assets/img/features/img-3.jpg" alt="">
                    </a>
                  </figure>
                  <div class="item-body">
                    <h3 class="job-title"><a href="job-page.html">Managing Director</a></h3>
                    <div class="adderess"><i class="ti-location-pin"></i> NY, United States</div>
                  </div>
                </div>
              </div>
              <div class="item-foot">
                <span><i class="ti-calendar"></i> 3 months ago</span>
                <span><i class="ti-time"></i> Full Time</span>
                <div class="view-iocn">
                  <a href="job-page.html"><i class="ti-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="featured-item">
              <div class="featured-wrap">
                <div class="featured-inner">
                  <figure class="item-thumb">
                    <a class="hover-effect" href="job-page.html">
                      <img src="portal/assets/img/features/img-3.jpg" alt="">
                    </a>
                  </figure>
                  <div class="item-body">
                    <h3 class="job-title"><a href="job-page.html">Graphic Designer</a></h3>
                    <div class="adderess"><i class="ti-location-pin"></i> Washington, United States</div>
                  </div>
                </div>
              </div>
              <div class="item-foot">
                <span><i class="ti-calendar"></i> 1 months ago</span>
                <span><i class="ti-time"></i> Part Time</span>
                <div class="view-iocn">
                  <a href="job-page.html"><i class="ti-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="featured-item">
              <div class="featured-wrap">
                <div class="featured-inner">
                  <figure class="item-thumb">
                    <a class="hover-effect" href="job-page.html">
                      <img src="portal/assets/img/features/img-2.jpg" alt="">
                    </a>
                  </figure>
                  <div class="item-body">
                    <h3 class="job-title"><a href="job-page.html">Software Engineer</a></h3>
                    <div class="adderess"><i class="ti-location-pin"></i> Dallas, United States</div>
                  </div>
                </div>
              </div>
              <div class="item-foot">
                <span><i class="ti-calendar"></i> 6 months ago</span>
                <span><i class="ti-time"></i> Full Time</span>
                <div class="view-iocn">
                  <a href="job-page.html"><i class="ti-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="featured-item">
              <div class="featured-wrap">
                <div class="featured-inner">
                  <figure class="item-thumb">
                    <a class="hover-effect" href="job-page.html">
                      <img src="portal/assets/img/features/img-1.jpg" alt="">
                    </a>
                  </figure>
                  <div class="item-body">
                    <h3 class="job-title"><a href="job-page.html">Managing Director</a></h3>
                    <div class="adderess"><i class="ti-location-pin"></i> NY, United States</div>
                  </div>
                </div>
              </div>
              <div class="item-foot">
                <span><i class="ti-calendar"></i> 7 months ago</span>
                <span><i class="ti-time"></i> Part Time</span>
                <div class="view-iocn">
                  <a href="job-page.html"><i class="ti-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Featured Jobs Section End -->

    <!-- Pricing Table Section -->
    <section id="pricing-table" class="section" style="background-color: #ffffff;">
      <div class="container">
        <div class="row">
          @foreach($packages as $pkg)
          <div class="col-sm-3">
            <div class="table">
              <div class="title">
                <h3>{{ $pkg->name }}</h3>
              </div>
              <div class="pricing-header">
                <p class="price-value">${{ $pkg->price }}</p>
                <p class="price-quality">/{{ $pkg->duration_days }} days</p>
              </div>
              <ul class="description">
                @foreach(explode(',', $pkg->features) as $feature)
                  <li>{{ $feature }}</li>
                @endforeach
              </ul>
              <button class="btn btn-common" type="button">Get Started</button>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- Pricing Table Section End -->

    <!-- Blog Section -->
    <section id="blog" class="section">
      <!-- Container Starts -->
      <div class="container">
        <h2 class="section-title">
          Latest News
        </h2>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 blog-item">
            <!-- Blog Item Starts -->
            <div class="blog-item-wrapper">
              <div class="blog-item-img">
                <a href="single-post.html">
                  <img src="portal/assets/img/blog/home-items/img1.jpg" alt="">
                </a>
              </div>
              <div class="blog-item-text">
                <div class="meta-tags">
                  <span class="date"><i class="ti-calendar"></i> Dec 20, 2017</span>
                  <span class="comments"><a href="#"><i class="ti-comment-alt"></i> 5 Comments</a></span>
                </div>
                <a href="single-post.html">
                  <h3>
                    Tips to write an impressive resume online for beginner
                  </h3>
                </a>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore praesentium asperiores ad vitae.
                </p>
                <a href="single-post.html" class="btn btn-common btn-rm">Read More</a>
              </div>
            </div>
            <!-- Blog Item Wrapper Ends-->
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 blog-item">
            <!-- Blog Item Starts -->
            <div class="blog-item-wrapper">
              <div class="blog-item-img">
                <a href="single-post.html">
                  <img src="portal/assets/img/blog/home-items/img2.jpg" alt="">
                </a>
              </div>
              <div class="blog-item-text">
                <div class="meta-tags">
                  <span class="date"><i class="ti-calendar"></i> Jan 20, 2018</span>
                  <span class="comments"><a href="#"><i class="ti-comment-alt"></i> 5 Comments</a></span>
                </div>
                <a href="single-post.html">
                  <h3>
                    Let's explore 5 cool new features in TalentStream theme
                  </h3>
                </a>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore praesentium asperiores ad vitae.
                </p>
                <a href="single-post.html" class="btn btn-common btn-rm">Read More</a>
              </div>
            </div>
            <!-- Blog Item Wrapper Ends-->
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 blog-item">
            <!-- Blog Item Starts -->
            <div class="blog-item-wrapper">
              <div class="blog-item-img">
                <a href="single-post.html">
                  <img src="portal/assets/img/blog/home-items/img3.jpg" alt="">
                </a>
              </div>
              <div class="blog-item-text">
                <div class="meta-tags">
                  <span class="date"><i class="ti-calendar"></i> Mar 20, 2018</span>
                  <span class="comments"><a href="#"><i class="ti-comment-alt"></i> 5 Comments</a></span>
                </div>
                <a href="single-post.html">
                  <h3>
                    How to convince recruiters and get your dream job
                  </h3>
                </a>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore praesentium asperiores ad vitae.
                </p>
                <a href="single-post.html" class="btn btn-common btn-rm">Read More</a>
              </div>
            </div>
            <!-- Blog Item Wrapper Ends-->
          </div>
        </div>
      </div>
    </section>
    <!-- blog Section End -->

    <!-- Testimonial Section Start -->
    <section id="testimonial" class="section">
      <div class="container">
        <div class="row">
          <div class="touch-slider" class="owl-carousel owl-theme">
            <div class="item active text-center">
              <img class="img-member" src="portal/assets/img/testimonial/img1.jpg" alt="">
              <div class="client-info">
                <h2 class="client-name">Jessica <span>(Senior Accountant)</span></h2>
              </div>
              <p><i class="fa fa-quote-left quote-left"></i> The team that was assigned to our project... were extremely
                professional <i class="fa fa-quote-right quote-right"></i><br> throughout the project and assured that
                the owner expectations were met and <br> often exceeded. </p>
            </div>
            <div class="item text-center">
              <img class="img-member" src="portal/assets/img/testimonial/img2.jpg" alt="">
              <div class="client-info">
                <h2 class="client-name">John Doe <span>(Project Menager)</span></h2>
              </div>
              <p><i class="fa fa-quote-left quote-left"></i> The team that was assigned to our project... were extremely
                professional <i class="fa fa-quote-right quote-right"></i><br> throughout the project and assured that
                the owner expectations were met and <br> often exceeded. </p>
            </div>
            <div class="item text-center">
              <img class="img-member" src="portal/assets/img/testimonial/img3.jpg" alt="">
              <div class="client-info">
                <h2 class="client-name">Helen <span>(Engineer)</span></h2>
              </div>
              <p><i class="fa fa-quote-left quote-left"></i> The team that was assigned to our project... were extremely
                professional <i class="fa fa-quote-right quote-right"></i><br> throughout the project and assured that
                the owner expectations were met and <br> often exceeded. </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Clients Section -->
    <section class="clients section">
    <div class="container">
        <h2 class="section-title">
            Clients &amp; Partners
        </h2>
        <div class="row">
            <div id="clients-scroller" class="owl-carousel owl-theme">
                {{-- Each client item --}}
                <div class="items">
                    <img src="{{ asset('portal/assets/img/clients/img1.png') }}" alt="Client 1">
                </div>
                <div class="items">
                    <img src="{{ asset('portal/assets/img/clients/img2.png') }}" alt="Client 2">
                </div>
                <div class="items">
                    <img src="{{ asset('portal/assets/img/clients/img3.png') }}" alt="Client 3">
                </div>
                <div class="items">
                    <img src="{{ asset('portal/assets/img/clients/img4.png') }}" alt="Client 4">
                </div>
                <div class="items">
                    <img src="{{ asset('portal/assets/img/clients/img5.png') }}" alt="Client 5">
                </div>
                <div class="items">
                    <img src="{{ asset('portal/assets/img/clients/img6.png') }}" alt="Client 6">
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Client Section End -->

    <!-- Counter Section Start -->
   <section id="counter">
    <div class="container">
        <div class="row">
            @php
                $counterItems = [
                    ['icon' => 'ti-briefcase', 'title' => 'Jobs', 'value' => $counters['jobs']],
                    ['icon' => 'ti-user', 'title' => 'Members', 'value' => $counters['members']],
                    ['icon' => 'ti-write', 'title' => 'Resume', 'value' => $counters['resumes']],
                    ['icon' => 'ti-heart', 'title' => 'Company', 'value' => $counters['companies']],
                ];
            @endphp

            @foreach($counterItems as $item)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting">
                    <div class="icon">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>
                    <div class="desc">
                        <h2>{{ $item['title'] }}</h2>
                        <h1 class="counter">{{ $item['value'] }}</h1>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

  <!-- Counter Section End -->

    <!-- Infobox Section Start -->
    <section class="infobox section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="info-text">
              <h2>Don't Want To Miss a Thing?</h2>
              <p>Just go to <a href="#">Google Play</a> to download JobBoard Mini</p>
            </div>
            <a href="#" class="btn btn-border">Google Play</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Infobox Section End -->

@endsection