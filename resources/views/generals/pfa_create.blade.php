@extends('layouts.app')
@section('title') Users
@endsection

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Manage Users</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('home') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Create</a>
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
                                    {!! Form::open(['route' => ['pfa.store'], 'class' => 'form-control', 'method' => 'POST', 'id' => 'main', 'files' => true])
                                    !!}
                                        <h4 class="sub-title"><strong>User Enrollment</strong></h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Full Name</label>
                                            <div class="col-sm-6">
                                                {!! Form::text('name', $user->name, ['class' => "form-control {{ $errors->has('name') ? ' is-invalid' : '' }}", 'placeholder'=>
                                                'Full Name']) !!} @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Mobile Number</label>
                                            <div class="col-sm-6">
                                                {!! Form::text('phone_number', $user->phoneno, ['class' => "form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}",
                                                'placeholder'=> 'Mobile Number']) !!} @if ($errors->has('phone_number'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Department</label>
                                            <div class="col-sm-6">
                                                {!! Form::select('department_id', [null => 'Choose Department']+$departments, null, ['class' => "form-control {{ $errors->has('department_id')
                                                ? ' is-invalid' : '' }}"]) !!} @if ($errors->has('department_id'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('department_id') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Team</label>
                                            <div class="col-sm-6">
                                                {!! Form::select('team_id', [null => 'Choose a Team']+$teams, null, ['class' => "form-control {{ $errors->has('team_id')
                                                ? ' is-invalid' : '' }}"]) !!} @if ($errors->has('team_id'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('team_id') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Region</label>
                                            <div class="col-sm-6">
                                                {!! Form::select('region_id', [null => 'Choose a Region']+$regions, null, ['class' => "form-control {{ $errors->has('region_id')
                                                ? ' is-invalid' : '' }}"]) !!} @if ($errors->has('region_id'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('region_id') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        @if(Route::has('users.edit'))
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">LeaderShip Worthy</label>
                                            <div class="col-sm-6">
                                                <div class="form-radio">
                                                    <div class="radio radiofill radio-primary radio-inline">
                                                        <label>
                                                                    {!! Form::radio('leadership_worthy', '1', ['data-bv-field' => 'leadership_worthy', 'class' => 'form-control']) !!}
                                                                    <i class="helper"></i>Active
                                                                </label>
                                                    </div>
                                                    <div class="radio radiofill radio-primary radio-inline">
                                                        <label>
                                                                    {!! Form::radio('leadership_worthy', '0', ['data-bv-field' => 'leadership_worthy', 'class' => 'form-control']) !!}
                                                                    <i class="helper"></i>Deactivated
                                                                </label>
                                                    </div>
                                                </div>
                                                @if ($errors->has('leadership_worthy'))
                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('leadership_worthy') }}</strong>
                                                            </span> @endif
                                            </div>
                                        </div>
                                        @endif @if(Route::has('users.edit'))
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Status</label>
                                            <div class="col-sm-6">
                                                <div class="form-radio">
                                                    <div class="radio radiofill radio-primary radio-inline">
                                                        <label>
                                                                {!! Form::radio('status', '1', ['data-bv-field' => 'status', 'class' => 'form-control']) !!}
                                                                <i class="helper"></i>Active
                                                            </label>
                                                    </div>
                                                    <div class="radio radiofill radio-primary radio-inline">
                                                        <label>
                                                                {!! Form::radio('status', '0', ['data-bv-field' => 'status', 'class' => 'form-control']) !!}
                                                                <i class="helper"></i>Deactivated
                                                            </label>
                                                    </div>
                                                </div>
                                                @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Upload Photo</label>
                                            <div class="col-sm-6">
                                                {!! Form::file('photo', null, ['class' => "form-control {{ $errors->has('photo') ? ' is-invalid' : '' }}", 'placeholder'=>
                                                'Full Name']) !!} @if ($errors->has('photo'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('photo') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <h4 class="sub-title"><strong>User Login Details</strong></h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">User Role</label>
                                            <div class="col-sm-6">
                                                {!! Form::select('role', [null => 'Select User Role']+$roles, null, ['class' => "form-control {{ $errors->has('name') ? '
                                                is-invalid' : '' }}"]) !!} @if ($errors->has('role'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('role') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Staff ID</label>
                                            <div class="col-sm-6">
                                                {!! Form::text('staffId', $user->staffId, ['class' => "form-control {{ $errors->has('staffId') ? ' is-invalid' : '' }}", 'placeholder'=>
                                                'Staff ID']) !!} @if ($errors->has('staffId'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('staffId') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Email</label>
                                            <div class="col-sm-6">
                                                {!! Form::email('email', $user->email, ['class' => "form-control {{ $errors->has('email') ? ' is-invalid' : '' }}", 'placeholder'=>
                                                'Email Address']) !!} @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Password</label>
                                            <div class="col-sm-6">
                                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                                    placeholder="Password"> @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right">Confirm Password</label>
                                            <div class="col-sm-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">        @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span> @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3"></label>
                                            <div class="col-sm-6 text-right">
                                                <a href="{{ route('pin.recon') }}" class="btn btn-primary m-b-0">Cancel</a>
                                                <button type="submit" class="btn btn-primary m-b-0">Register</button>
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
