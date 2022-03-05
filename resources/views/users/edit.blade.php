@extends('layouts.app')

@section('title')
    Patients
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
                        <li class="breadcrumb-item"><a href="#!">{{ $user->name }} Update</a>
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
                                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PATCH', 'id' => 'main', 'files'=>true]) !!}
                                        @include('users.form')
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
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endpush
@push('js')
    <!-- data-table js -->
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/pages/data-table/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/pages/data-table/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/pages/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Custom js -->
    <script src="{{ asset('assets/pages/data-table/js/data-table-custom.js') }}"></script>

@endpush
