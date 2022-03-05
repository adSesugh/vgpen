@extends('layouts.app')
@section('title') Region Members
@endsection

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Region Members</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('home') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('regions.index') }}">Region</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Members</a>
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
                                    <div class="row">
                                        @foreach ($region_members as $item)
                                        <div class="col-md-6 col-xl-4">
                                            <div class="card client-map">
                                                <div class="card-block">
                                                    <a href="{{ route('home', $item->id) }}">
                                                        <div class="client-detail">
                                                            <div class="client-profile">
                                                                <img src="@if(empty($item->photo)) {{ asset('assets/images/avatar-2.jpg') }} @else {{ $item->photo }} @endif" alt="">
                                                            </div>
                                                            <div class="client-contain">
                                                                <h5><a href="#;" data-placement="top" data-toggle="tooltip" data-original-title="{{ $item->name }}">{{ str_limit($item->name, 15, $end='...') }}</a></h5>
                                                                <a href="#!" class="text-muted">{{ $item->email }}</a>
                                                                <p class="text-muted m-0 p-t-10">
                                                                    @if($item->id) @foreach ( \DB::table('roles')->join('role_user', 'role_user.role_id', 'roles.id')->where('role_user.user_id',
                                                                    $item->id)->get() as $role )
                                                                    <span class="label label-primary text-center">{{ $role->display_name }}</span>                                                                @endforeach @else
                                                                    <span class="label label-primary  text-center">Not Assigned</span>                                                                @endif &nbsp;&nbsp;&nbsp;
                                                                    <span class="label label-warning text-right"><small>{{ $item->region->region_name }}</small></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <div class="client-card-box">
                                                                <div class="row">
                                                                    <div class="col-5 text-center client-border p-10">
                                                                        <p class="text-muted m-0">Target</p>
                                                                        <span class="text-c-blue f-20 f-w-600">345</span>
                                                                    </div>
                                                                    <div class="col-5 text-center p-10">
                                                                        <p class="text-muted m-0">Acheived</p>
                                                                        <span class="text-c-blue f-20 f-w-600">12</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
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
