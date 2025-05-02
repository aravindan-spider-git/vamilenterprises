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
                                <h4 class="text-center mb-4">Create an account</h4>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Name</strong></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Email Address</strong></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group position-relative">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" name="password" id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               required>
                                        <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group position-relative">
                                        <label class="mb-1"><strong>Confirm Password</strong></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="form-control" required>
                                    </div>

                                    <!-- Submit -->
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                </form>

                                <div class="form-group justify-content-center mt-3 text-center">
                                    <a href="{{ route('login') }}">Already have an account? Sign in</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>

<style>
    .position-relative {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Toggle password visibility
    $(document).ready(function(){
        $(".toggle-password").click(function() {
            var input = $($(this).attr("toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
</script>
@endsection
