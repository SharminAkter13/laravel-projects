@extends('main')

@section('content')
<!-- Page Header Start -->
<div class="page-header" style="background: url(portal/assets/img/banner1.jpg);">
  <div class="container">
    <div class="row">         
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">My Account</h2>
          <ol class="breadcrumb">
            <li><a href="#"><i class="ti-home"></i> Home</a></li>
            <li class="current">My Account</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page Header End -->   

<div id="content" class="my-account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-6 cd-user-modal">  
        <div class="my-account-form">
          <ul class="cd-switcher">
            <li><a class="selected" href="#0">LOGIN</a></li>
            <li><a href="#0">REGISTER</a></li>
          </ul>

          <!-- Login -->
          <div id="cd-login" class="is-selected">
            <div class="page-login-form">
              <!-- Display messages -->
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif

              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <div class="input-icon">
                    <i class="ti-email"></i>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-icon">
                    <i class="ti-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                </div> 
                <button type="submit" class="btn btn-common log-btn">Login</button>
                <div class="checkbox-item">
                  <div class="checkbox">
                    <label for="rememberme" class="rememberme">
                      <input name="remember" id="rememberme" type="checkbox"> Remember Me
                    </label>
                  </div>                        
                  <p class="cd-form-bottom-message"><a href="#0">Lost your password?</a></p>
                </div> 
              </form>
            </div>
          </div>

          <!-- Register -->
          <div id="cd-signup">
            <div class="page-login-form register">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <div class="input-icon">
                    <i class="ti-user"></i>
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-icon">
                    <i class="ti-email"></i>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-icon">
                    <i class="ti-lock"></i>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-icon">
                    <i class="ti-lock"></i>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <select id="role" name="role" class="form-control" required>
                    <option value="candidate">Candidate</option>
                    <option value="employer">Employer</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-common log-btn">Register</button> 
              </form>
            </div>
          </div>

          <!-- Reset Password (optional placeholder) -->
          <div class="page-login-form" id="cd-reset-password">
            <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to reset your password.</p>
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="form-group">
                <div class="input-icon">
                  <i class="ti-email"></i>
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
              </div> 
              <p class="fieldset">
                <button class="btn btn-common log-btn" type="submit">Reset password</button> 
              </p>
            </form>
            <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>   
@endsection
