@extends('layouts.home')

@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <img src="" alt="Vamil Enterprises" style="max-height: 100px; width: 300px;">
                                </div>
                                <h4 class="text-center mb-4">Sign in your account</h4>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <label class="mb-1"><strong>{{ __('Email Address') }}</strong></label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                        </div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative">
                                        <label class="mb-1"><strong>Password</strong></label>
                                       <div class="input-group transparent-append">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        </div>
                                        <input id="dz-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <div class="input-group-append show-pass ">
                                            <span class="input-group-text "> 
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>

                                       </div>
                                                                              
                                        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                           <div class="custom-control custom-checkbox ml-1">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                </form>
                                <div class="form-group justify-content-center mt-3 text-center">
                                    <a href="{{ route('register') }}">Register</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Jquery Validation -->
    <script src="{{ asset('/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Form validate init -->
    <script src="{{ asset('/js/plugins-init/jquery.validate-init.js') }}"></script>
@endsection
