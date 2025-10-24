@extends('main')

@section('content')

<!-- Page Header Start - Kept your custom banner structure -->

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

                <!-- Login Form (Laravel Logic Integrated) -->
                <div id="cd-login" class="is-selected">
                    <div class="page-login-form">
                        <!-- Correct form action and method, plus CSRF token -->
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="ti-user"></i>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                                        placeholder="Email Address">
                                </div>
                                <!-- Laravel Email Error Handling -->
                                @error('email')
                                    <div class="text-danger mt-2" role="alert" style="font-size: 0.9em;">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div> 
                            
                            <!-- Password Field -->
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="ti-lock"></i>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required autocomplete="current-password" 
                                        placeholder="Password">
                                </div>
                                <!-- Laravel Password Error Handling -->
                                @error('password')
                                    <div class="text-danger mt-2" role="alert" style="font-size: 0.9em;">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div> 
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-common log-btn">{{ __('Login') }}</button>

                            <div class="checkbox-item">
                                <div class="checkbox">
                                    <!-- Laravel Remember Me Checkbox -->
                                    <label for="remember" class="rememberme">
                                        <input name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}> 
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>          
                                
                                <!-- Laravel Forgot Password Link -->
                                @if (Route::has('password.request'))
                                    <p class="cd-form-bottom-message">
                                        <a href="{{ route('password.request') }}">{{ __('Lost your password?') }}</a>
                                    </p>
                                @endif
                            </div> 
                        </form>
                    </div>
                </div>

                <!-- Register Form - Updated field names for basic Laravel readiness -->
                <div id="cd-signup">
                    <div class="page-login-form register">
                        <form role="form" class="login-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="ti-user"></i>
                                    <input type="text" class="form-control" name="name" placeholder="Username" required autocomplete="name">
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="ti-email"></i>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="email">
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="ti-lock"></i>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="new-password">
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="ti-lock"></i>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group">
                            <select id="role" name="role" class="form-control" required>
                                <option value="" disabled selected>Register as</option>
                                <option value="candidate">Candidate</option>
                                <option value="employer">Employer</option>
                            </select>
                            </div>                            
                            <button type="submit" class="btn btn-common log-btn">{{ __('Register') }}</button> 
                        </form>
                    </div>
                </div>

                <!-- Reset Password Form - Updated form action and field name -->
                <div class="page-login-form" id="cd-reset-password">
                    <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>
                    <form method="POST" action="{{ route('password.email') }}" class="cd-form">
                        @csrf
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="ti-email"></i>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div> 
                        <p class="fieldset">
                            <button class="btn btn-common log-btn" type="submit">{{ __('Send Password Reset Link') }}</button> 
                        </p>
                    </form>
                    <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
                </div> <!-- cd-reset-password -->
            </div>
        </div>
    </div>
</div>


</div>
@endsection