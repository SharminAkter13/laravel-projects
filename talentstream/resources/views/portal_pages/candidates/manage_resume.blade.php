@extends('main')
@section('content')
      <!-- Page Header Start -->
      <div class="page-header" style="background: url(portal/assets/img/banner1.jpg);">
        <div class="container">
          <div class="row">         
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">Manage Resumes</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Manage Resumes</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Header End --> 
   <!-- Start Content -->
      <div id="content">
        <div class="container">        
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="right-sideabr">
                <div class="inner-box">
                  <h4>Manage Account</h4>
                  <ul class="lest item">
                    <li><a href="resume.html">My Resume</a></li>
                    <li><a href="bookmarked.html">Bookmarked Jobs</a></li>
                    <li><a href="notifications.html">Notifications <span class="notinumber">2</span></a></li>
                  </ul>
                  <h4>Manage Job</h4>
                  <ul class="lest item">
                    <li><a href="job-alerts.html">Manage Jobs</a></li>
                    <li><a href="manage-applications.html">Manage Applications</a></li>                   
                    <li><a class="active" href="manage-resumes.html">Manage Resume</a></li>                  
                  </ul>
                  <ul class="lest">
                    <li><a href="change-password.html">Change Password</a></li>
                    <li><a href="index.html">Sing Out</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="job-alerts-item candidates">
                <h3 class="alerts-title">Manage Resumes</h3>
                <div class="manager-resumes-item">
                  <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="portal/assets/img/jobs/avatar.jpg" alt=""></a>
                    <div class="manager-info">
                      <div class="manager-name">
                        <h4><a href="#">John Doe</a></h4>
                        <h5>Front-end developer</h5>
                      </div>
                      <div class="manager-meta">
                        <span class="location"><i class="ti-location-pin"></i> Cupertino, CA, USA</span>
                        <span class="rate"><i class="ti-time"></i> $55 per hour</span>
                      </div>
                    </div>
                  </div>
                  <div class="update-date">
                    <p class="status">
                      <strong>Updated on:</strong> Fab 22, 2017
                    </p>
                    <div class="action-btn">
                      <a class="btn btn-xs btn-gray" href="#">Hide</a>
                      <a class="btn btn-xs btn-gray" href="#">Edit</a>
                      <a class="btn btn-xs btn-danger" href="#">Delete</a>
                    </div>
                  </div>
                </div>     
                <div class="manager-resumes-item">
                  <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="portal/assets/img/jobs/avatar.jpg" alt=""></a>
                    <div class="manager-info">
                      <div class="manager-name">
                        <h4><a href="#">John Doe</a></h4>
                        <h5>Front-end developer</h5>
                      </div>
                      <div class="manager-meta">
                        <span class="location"><i class="ti-location-pin"></i> Cupertino, CA, USA</span>
                        <span class="rate"><i class="ti-time"></i> $55 per hour</span>
                      </div>
                    </div>
                  </div>
                  <div class="update-date">
                    <p class="status">
                      <strong>Updated on:</strong> Fab 22, 2017
                    </p>
                    <div class="action-btn">
                      <a class="btn btn-xs btn-gray" href="#">Hide</a>
                      <a class="btn btn-xs btn-gray" href="#">Edit</a>
                      <a class="btn btn-xs btn-danger" href="#">Delete</a>
                    </div>
                  </div>
                </div>  
                <div class="manager-resumes-item">
                  <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="portal/assets/img/jobs/avatar.jpg" alt=""></a>
                    <div class="manager-info">
                      <div class="manager-name">
                        <h4><a href="#">John Doe</a></h4>
                        <h5>Front-end developer</h5>
                      </div>
                      <div class="manager-meta">
                        <span class="location"><i class="ti-location-pin"></i> Cupertino, CA, USA</span>
                        <span class="rate"><i class="ti-time"></i> $55 per hour</span>
                      </div>
                    </div>
                  </div>
                  <div class="update-date">
                    <p class="status">
                      <strong>Updated on:</strong> Fab 22, 2017
                    </p>
                    <div class="action-btn">
                      <a class="btn btn-xs btn-gray" href="#">Hide</a>
                      <a class="btn btn-xs btn-gray" href="#">Edit</a>
                      <a class="btn btn-xs btn-danger" href="#">Delete</a>
                    </div>
                  </div>
                </div>  
                <div class="manager-resumes-item">
                  <div class="manager-content">
                    <a href="resume.html"><img class="resume-thumb" src="portal/assets/img/jobs/avatar.jpg" alt=""></a>
                    <div class="manager-info">
                      <div class="manager-name">
                        <h4><a href="#">John Doe</a></h4>
                        <h5>Front-end developer</h5>
                      </div>
                      <div class="manager-meta">
                        <span class="location"><i class="ti-location-pin"></i> Cupertino, CA, USA</span>
                        <span class="rate"><i class="ti-time"></i> $55 per hour</span>
                      </div>
                    </div>
                  </div>
                  <div class="update-date">
                    <p class="status">
                      <strong>Updated on:</strong> Fab 22, 2017
                    </p>
                    <div class="action-btn">
                      <a class="btn btn-xs btn-gray" href="#">Hide</a>
                      <a class="btn btn-xs btn-gray" href="#">Edit</a>
                      <a class="btn btn-xs btn-danger" href="#">Delete</a>
                    </div>
                  </div>
                </div>    
                <a class="btn btn-common btn-sm" href="add-resume.html">Add new resume</a>
              </div>
            </div>
          </div>
        </div>      
      </div>
      <!-- End Content -->


@endsection