@extends('master')

@section('content')
<!-- Page Header Start -->
<div class="page-header" style="background-image: url('{{ asset('assets/img/banner1.jpg') }}');">
    <div class="container">
        <div class="row">         
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    <h2 class="product-title">Reset Password</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="ti-home"></i> Home</a></li>
                        <li class="current">Reset Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div id="content" class="my-account">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="my-account-form">
                    <div class="page-login-form">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="ti-email"></i>
                                    <input type="email" name="email" value="{{ old('email') }}" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        placeholder="Enter your email" required autofocus>
                                </div>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="btn btn-common log-btn" type="submit">Send Password Reset Link</button>
                        </form>

                        <p class="mt-3">
                            <a href="{{ route('login.show') }}">Back to Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
