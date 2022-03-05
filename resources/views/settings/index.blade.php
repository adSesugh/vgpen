@extends('layouts.app')

@section('title')
    Settings
@endsection

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Manage Settings</h4>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('home') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">List/Update</a>
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
                                        {!! Form::open(['route' => ['settings.store'], 'method' => 'POST', 'id' => 'main']) !!}
                                            @include('settings.form')
                                            <div class="col-sm-6 text-right">
                                                <a href="{{ route('users.index') }}" class="btn btn-primary m-b-0">Cancel</a>
                                                <button type="submit" class="btn btn-primary m-b-0">Save Changes</button>
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

@push('css')
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/advance-elements/css/bootstrap-datetimepicker.css') }}">
@endpush

@push('js')
    <!-- Bootstrap date-time-picker js -->
    <script type="text/javascript" src="{{ asset('assets/pages/advance-elements/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/pages/advance-elements/bootstrap-datetimepicker.min.js') }}"></script>
@endpush
