@extends('layouts.app')

@section('title')
    Change Password
@endsection

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Manage Password</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('home') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript::void(0)">Users</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Change Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    {!! Form::model($user, ['route' => ['changepassword', $user->id], 'class' => 'form-control', 'method' => 'PATCH', 'id' => 'main']) !!}
                                        <h4 class="sub-title"><strong>User Login Details</strong></h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Staff ID</label>
                                            <div class="col-sm-6">
                                                {!! Form::text('staffId', null, ['class' => "form-control {{ $errors->has('staffId') ? ' is-invalid' : '' }}", 'placeholder'=>
                                                'Staff ID', 'readonly' => true]) !!} @if ($errors->has('staffId'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('staffId') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Email</label>
                                            <div class="col-sm-6">
                                                {!! Form::email('email', null, ['class' => "form-control {{ $errors->has('email') ? ' is-invalid' : '' }}", 'placeholder'=>
                                                'Email Address', 'readonly' => true]) !!} @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Current Password</label>
                                            <div class="col-sm-6">
                                                <input id="currentpassword" type="password" class="form-control {{ $errors->has('currentpassword') ? ' is-invalid' : '' }}" name="currentpassword"
                                                    placeholder="Password">
                                                @if ($errors->has('currentpassword'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('currentpassword') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Password</label>
                                            <div class="col-sm-6">
                                                <input id="newpassword" type="password" class="form-control {{ $errors->has('newpassword') ? ' is-invalid' : '' }}" name="newpassword"
                                                    placeholder="New Password">
                                                @if ($errors->has('newpassword'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('newpassword') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Confirm Password</label>
                                            <div class="col-sm-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                                @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3"></label>
                                            <div class="col-sm-6 text-right">
                                                <a href="{{ route('home') }}" class="btn btn-primary m-b-0">Cancel</a>
                                                <button type="submit" class="btn btn-primary m-b-0">Save Changes</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

