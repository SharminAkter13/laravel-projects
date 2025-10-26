@extends('main')
@section('content')
   <!-- Page Header Start -->
      <div class="page-header" style="background:url('{{ asset('portal/assets/img/banner1.jpg') }}');">
        <div class="container">
          <div class="row">         
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">Categories</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Browse Categories</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Header End --> 

      <!-- Category Section Start -->
      <section class="section" >
        <div class="container">
          <h2 class="section-title">Browse Categories</h2>  
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                    <i class="ti-home"></i>
                  </div>
                  <h3>Finance</h3>
                  <p>4286 jobs</p>
                </a>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                   <i class="ti-world"></i>
                  </div>
                  <h3>Sale/Markting</h3>
                  <p>2000 jobs</p>
                </a>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                   <i class="ti-book"></i>
                  </div>
                  <h3>Education/Training</h3>
                  <p>1450 jobs</p>
                </a>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                   <i class="ti-desktop"></i>
                  </div>
                  <h3>Technologies</h3>
                  <p>5100 jobs</p>
                </a>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                    <i class="ti-brush"></i>
                  </div>
                  <h3>Art/Design</h3>
                  <p>5079 jobs</p>
                </a>
              </div>            
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                  <i class="ti-heart"></i>
                  </div>
                  <h3>Healthcare</h3>
                  <p>3235 jobs</p>
                </a>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                   <i class="ti-filter"></i>
                  </div> 
                  <h3>Science</h3>
                  <p>1800 jobs</p> 
                </a>
              </div>            
              <div class="col-md-3 col-sm-3 col-xs-12 f-category">
                <a href="browse-categories.html">
                  <div class="icon">
                   <i class="ti-cup"></i>
                  </div>
                  <h3>Food Services</h3>
                  <p>4286 jobs</p>
                </a>
              </div>
            </div> 
          </div>
        </div>
      </section>
      <!-- Category Section End -->  

      <!-- Browse All Categories Section Start -->
      <section class="all-categories section">
        <div class="container">
          <h2 class="section-title">Browse All Categories</h2> 
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h3 class="cat-title">Business <span>(33 Sub Categories)</span></h3>
            </div>            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Accounting & Finance</a></li>
                <li><a href="#">Asset Management</a></li>
                <li><a href="#">Capital Markets</a></li>
                <li><a href="#">Commercial Banking</a></li>
                <li><a href="#">Commodities</a></li>
                <li><a href="#">Consultiong</a></li>
                <li><a href="#">Corporate</a></li>
                <li><a href="#">Credit</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Debt/Fixed Income</a></li>
                <li><a href="#">Derivatives</a></li>
                <li><a href="#">Equities</a></li>
                <li><a href="#">FX & Money Markets</a></li>
                <li><a href="#">Global Custody</a></li>
                <li><a href="#">Covernment</a></li>
                <li><a href="#">Graduates & Internships</a></li>
                <li><a href="#">Hedge Funds</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Information Services</a></li>
                <li><a href="#">Insurance</a></li>
                <li><a href="#">Investment Consulting</a></li>
                <li><a href="#">Investment Banking</a></li>
                <li><a href="#">Islamic Finance</a></li>
                <li><a href="#">Operations</a></li>
                <li><a href="#">Private Banking & Wealth Management</a></li>
                <li><a href="#">Private Equity & Venture Capital</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Quantitative Analytics</a></li>
                <li><a href="#">Real Estate</a></li>
                <li><a href="#">Research</a></li>
                <li><a href="#">Retail Banking</a></li>
                <li><a href="#">Risk Management</a></li>
                <li><a href="#">Trading</a></li>
              </ul>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h3 class="cat-title">Science <span>(34 Sub Categories)</span></h3>
            </div>            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Aeronautical Engineering</a></li>
                <li><a href="#">Aerospace Engineering</a></li>
                <li><a href="#">Algorthm</a></li>
                <li><a href="#">Biology</a></li>
                <li><a href="#">Broadcast Engineering</a></li>
                <li><a href="#">Circuit Design</a></li>
                <li><a href="#">Civil Engineering</a></li>
                <li><a href="#">Clean Technology</a></li>
                <li><a href="#">Construction Monitoring</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Climate Sciences</a></li>
                <li><a href="#">Cryptography</a></li>
                <li><a href="#">Data Mining</a></li>
                <li><a href="#">Data Science</a></li>
                <li><a href="#">Digital Design</a></li>
                <li><a href="#">Drones</a></li>
                <li><a href="#">Electrical Engineering</a></li>
                <li><a href="#">Electronics</a></li>
                <li><a href="#">Engineering</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Gelolgy</a></li>
                <li><a href="#">Human Science</a></li>
                <li><a href="#">Imaging</a></li>
                <li><a href="#">Industrial Engineering</a></li>
                <li><a href="#">Instrumentation</a></li>
                <li><a href="#">Machine Learning</a></li>
                <li><a href="#">Mathematics</a></li>
                <li><a href="#">Machanical Engineering</a></li>
                <li><a href="#">Medical</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Nanotechnology</a></li>
                <li><a href="#">Natural Language</a></li>
                <li><a href="#">Physics</a></li>
                <li><a href="#">Quantum</a></li>
                <li><a href="#">Remote Sensing</a></li>
                <li><a href="#">Robotics</a></li>
                <li><a href="#">Statistics</a></li>
                <li><a href="#">Wireless</a></li>
              </ul>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h3 class="cat-title">Sales & Marketing <span>(21 Sub Categories)</span></h3>
            </div>            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Display Advertising</a></li>
                <li><a href="#">Email Marketing</a></li>
                <li><a href="#">Lead Generation</a></li>
                <li><a href="#">Market &amp; Customer Research</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Marketing Strategy</a></li>
                <li><a href="#">Public Relations</a></li>
                <li><a href="#">Telemarketing &amp; Telesales</a></li>
                <li><a href="#">Other - Sales &amp; Marketing</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">SEM - Search Engine Marketing</a></li>
                <li><a href="#">SEO - Search Engine Optimization</a></li>
                <li><a href="#">SMM - Social Media Marketing</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <ul>
                <li><a href="#">Climate Sciences</a></li>
                <li><a href="#">Cryptography</a></li>
                <li><a href="#">Data Mining</a></li>
                <li><a href="#">Digital Design</a></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <!-- Browse All Categories Section End -->


@endsection