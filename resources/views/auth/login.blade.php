@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('auth-content')
    <div class="row">
        <div class="col-sm-12">
            <!-- Authentication card start -->
            <form autocomplete="off" class="md-float-material form-material m-t-40 m-b-40" action="{{ route('login')}}" method="POST" novalidate id="main">
                @csrf
                <div class="auth-box card">
                    <div class="card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12">
                                <h3 class="text-center">Sign In</h3>
                            </div>
                        </div>
                        <div class="form-group form-primary">
                            <input type="text" name="login" id="login" class="form-control {{ $errors->has('login') ? ' is-invalid' : '' }}" required="">
                            <span class="form-bar"></span>
                            <label class="float-label">Staff ID Or Email</label>
                            @if ($errors->has('login'))
                                <span class="messages text-center" role="alert">
                                    <strong style="color:red;font-size:12px;">{{ $errors->first('login') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group form-primary">
                            <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required="">
                            <span class="form-bar"></span>
                            <label class="float-label">Password</label>
                            @if ($errors->has('password'))
                                <span class="messages" role="alert">
                                    <strong style="color:red;font-size:12px;">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row m-t-25 text-left">
                            <div class="col-12">
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Remember me</span>
                                    </label>
                                </div>
                                <div class="forgot-phone text-right float-right">
                                    <a href="{{ route('password.request') }}" class="text-right f-w-600"> Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                            </div>
                        </div>
                    </div>
                </div>
            <form>
            <!-- Authentication card end -->
        </div>
        <!-- end of col-sm-12 -->
    </div>
@endsection
@push('js')
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="assets/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- Validation js -->
    <script src="../../../cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="../../../cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" src="assets/pages/form-validation/validate.js"></script>
    <script type="text/javascript" src="assets/pages/form-validation/form-validation.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
@endpush
