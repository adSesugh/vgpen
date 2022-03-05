@extends('layouts.app')
@section('title')
    {{ $user->name }} Profile
@endsection

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Timeline</h4>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('home') }}">
                                        <i class="feather icon-home"></i>
                                    </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">{{ $user->name }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Timeline</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div>
                                    <div class="content social-timeline">
                                        <div class="">
                                            <!-- Row Starts -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Social wallpaper start -->
                                                    <div class="social-wallpaper">
                                                        <img src="{{ asset('assets/images/social/img1.jpg') }}" class="img-fluid width-100" alt="" />
                                                    </div>
                                                    <!-- Social wallpaper end -->
                                                </div>
                                            </div>
                                            <!-- Row end -->
                                            <!-- Row Starts -->
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
                                                    <!-- Social timeline left start -->
                                                    <div class="social-timeline-left">
                                                        <!-- social-profile card start -->
                                                        <div class="card">
                                                            <div class="social-profile">
                                                                <img class="img-fluid width-100" style="width:250px;height:250px;" src="@if(empty($user->photo)) {{ asset('assets/images/avatar-2.jpg') }} @else {{ $user->photo }} @endif" alt="">
                                                            </div>
                                                            <div class="card-block social-follower">
                                                                <h4><center><a data-placement="top" data-toggle="tooltip" data-original-title="{{ $user->name }}">{{ str_limit($user->name, 15, $end='...') }}</a></center></h4>
                                                                <h5><center>
                                                                    @if($user->id) @foreach ( \DB::table('roles')->join('role_user', 'role_user.role_id', 'roles.id')->where('role_user.user_id',
                                                                    $user->id)->get() as $role )
                                                                    <span class="label label-primary text-center">{{ $role->display_name }}</span> @endforeach @else
                                                                    <span class="label label-primary  text-center">Not Assigned</span> @endif
                                                                    </center>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Social timeline left end -->
                                                </div>
                                                <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 ">
                                                    <!-- Nav tabs -->
                                                    <div class="card social-tabs">
                                                        <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab" href="#about" role="tab">About {{ $user->name }}</a>
                                                                <div class="slide"></div>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#member" role="tab">{{ $user->team->team_name }} Members</a>
                                                                <div class="slide"></div>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#business" role="tab">Business(es)</a>
                                                                <div class="slide"></div>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#aum" role="tab">AUM</a>
                                                                <div class="slide"></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- Tab panes -->
                                                    <div class="tab-content">
                                                        <div class="tab-pane" id="about">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h5 class="card-header-text">Basic Information</h5>
                                                                        </div>
                                                                        <div class="card-block">
                                                                            <div id="view-info" class="row">
                                                                                <div class="col-lg-6 col-md-12">
                                                                                    <form>
                                                                                        <table class="table table-responsive m-b-0">
                                                                                            <tr>
                                                                                                <th class="social-label b-none p-t-0">Full Name
                                                                                                </th>
                                                                                                <td class="social-user-name b-none p-t-0 text-muted">{{ $user->name }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th class="social-label b-none">Staff ID</th>
                                                                                                <td class="social-user-name b-none text-muted">{{ $user->staffId }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th class="social-label b-none p-t-0">Phone Number
                                                                                                </th>
                                                                                                <td class="social-user-name b-none p-t-0 text-muted">{{ $user->phone_number }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th class="social-label b-none">Email Address</th>
                                                                                                <td class="social-user-name b-none text-muted">{{ $user->email }}</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-12">
                                                                                    <form>
                                                                                        <table class="table table-responsive m-b-0">
                                                                                            <tr>
                                                                                                <th class="social-label b-none p-t-0">Department
                                                                                                </th>
                                                                                                <td class="social-user-name b-none p-t-0 text-muted">@if(isset($user->department_id)){{ $user->department->department_name }}@endif</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th class="social-label b-none">Region</th>
                                                                                                <td class="social-user-name b-none text-muted">{{ $user->region->region_name }}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th class="social-label b-none p-t-0">Role
                                                                                                </th>
                                                                                                <td class="social-user-name b-none p-t-0 text-muted">
                                                                                                    @if($user->id) @foreach ( \DB::table('roles')->join('role_user', 'role_user.role_id', 'roles.id')->where('role_user.user_id',
                                                                                                    $user->id)->get() as $role )
                                                                                                    <span class="label label-primary text-center">{{ $role->display_name }}</span> @endforeach @else
                                                                                                    <span class="label label-primary  text-center">Not Assigned</span> @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th class="social-label b-none">Status</th>
                                                                                                <td class="social-user-name b-none text-muted">
                                                                                                    <span class="label label-primary">@if($user->status === 1 ) Active @else Deactivated @endif</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="member">
                                                            <div class="card">
                                                                <!-- Gallery start -->
                                                                <div class="card-block">
                                                                    <div class="row">
                                                                        @if($user->team_id) @foreach (\App\User::where('team_id', $user->team_id)->get() as $item)
                                                                            <div class="col-md-6 col-xl-6">
                                                                                <div class="card client-map">
                                                                                    <div class="card-block">
                                                                                        <div class="client-detail">
                                                                                            <div class="client-profile">
                                                                                                <img src="@if(empty($item->photo)) {{ asset('assets/images/avatar-2.jpg') }} @else {{ $item->photo }} @endif" alt="">
                                                                                            </div>
                                                                                            <div class="client-contain">
                                                                                                <h5>{{ str_limit($item->name, 15, $end='...') }}</h5>
                                                                                                <a href="#!" class="text-muted">{{ $item->email }}</a>
                                                                                                <p class="text-muted m-0 p-t-10">
                                                                                                    @if($item->id) @foreach ( \DB::table('roles')->join('role_user', 'role_user.role_id', 'roles.id')->where('role_user.user_id',
                                                                                                    $item->id)->get() as $role )
                                                                                                    <span class="label label-primary text-center">{{ $role->display_name }}</span> @endforeach @else
                                                                                                    <span class="label label-primary  text-center">Not Assigned</span> @endif &nbsp;&nbsp;&nbsp;
                                                                                                    <span class="label label-warning text-center"><small>{{ $item->region->region_name }}</small></span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="">
                                                                                            <div class="client-card-box">
                                                                                                <div class="row">
                                                                                                    <div class="col-6 text-center client-border p-10">
                                                                                                        <p class="text-muted m-0">Target</p>
                                                                                                        <span class="text-c-blue f-20 f-w-600">345</span>
                                                                                                    </div>
                                                                                                    <div class="col-6 text-center p-10">
                                                                                                        <p class="text-muted m-0">Acheived</p>
                                                                                                        <span class="text-c-blue f-20 f-w-600">12</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach @endif
                                                                    </div>
                                                                </div>

                                                                <!-- Gallery end -->
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="business">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="card">
                                                                        <div class="card-block">
                                                                            <div class="dt-responsive table-responsive">
                                                                                <table id="order-table" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Name</th>
                                                                                            <th>Employer</th>
                                                                                            <th>Start date</th>
                                                                                            <th>Contribution</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>Tiger Nixon</td>
                                                                                            <td>System Architect</td>
                                                                                            <td>2011/04/25</td>
                                                                                            <td>$320,800</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Friends tab end -->
                                                        <div class="tab-pane" id="aum">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="card">
                                                                        <div class="card-block">
                                                                            <div class="dt-responsive table-responsive">
                                                                                <table id="order-table" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Name</th>
                                                                                            <th>Employer</th>
                                                                                            <th>Start date</th>
                                                                                            <th>Contribution</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>Tiger Nixon</td>
                                                                                            <td>System Architect</td>
                                                                                            <td>2011/04/25</td>
                                                                                            <td>$320,800</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Row end -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->
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
@endpush @push('js')
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
<script type="text/javascript" src="{{ asset('assets/pages/issue-list/issue-list.js') }}"></script>

@endpush
