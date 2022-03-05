@extends('layouts.app')

@section('title')
    Users
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
                                    {!! Form::open(['route' => ['users.store'], 'class' => 'form-control', 'method' => 'POST', 'id' => 'main', 'files' => true]) !!}
                                        @include('users.form')
                                        <div class="form-group row">
                                            <label class="col-sm-3"></label>
                                            <div class="col-sm-6 text-right">
                                                <a href="{{ route('users.index') }}" class="btn btn-primary m-b-0">Cancel</a>
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

