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
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">List</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-right">
                        <a class="btn btn-xs btn-success" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> <span>Add User</span></a>
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
                                        <div class="dt-responsive table-responsive">
                                            <table id="issue-list-table" class="table dt-responsive width-100">
                                                <thead class="text-left">
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Name</th>
                                                        <th>Staff ID</th>
                                                        <th>Contact</th>
                                                        <th>Email</th>
                                                        <th>Department</th>
                                                        <th>Team</th>
                                                        <th>Region</th>
                                                        <th>Role</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-left">
                                                    @forelse ($users as $i => $item)
                                                        <tr>
                                                            <td class="txt-primary">{{ ++$i }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->staffId }}</td>
                                                            <td>{{ $item->phone_number }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>
                                                                @if($item->department_id)
                                                                    {{ $item->department->department_name }}
                                                                @else
                                                                    NULL
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($item->team_id) {{ $item->team->team_name }} @else NULL @endif
                                                            </td>
                                                            <td>
                                                                @if($item->region_id) {{ $item->region->region_name }} @else NULL @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if($item->id)
                                                                    @foreach ( \DB::table('roles')->join('role_user', 'role_user.role_id', 'roles.id')->where('role_user.user_id', $item->id)->get() as $role )
                                                                        <span class="label label-primary text-center">{{ $role->display_name }}</span>
                                                                    @endforeach
                                                                @else
                                                                    <span class="label label-primary  text-center">Not Assigned</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center"><span class="label label-primary">@if($item->status === 1 ) Active @else Deactivated @endif</span></td>
                                                            <td class="text-center">
                                                                <a href="{{ route('users.show', $item->id) }}" data-placement="top" data-toggle="tooltip" data-original-title="View Detail"><i class="feather icon-eye close-card"></i></a>
                                                                <a href="{{ route('users.edit', $item->id) }}" data-placement="top" data-toggle="tooltip" data-original-title="Edit Record"><i class="feather icon-edit close-card"></i></a>
                                                                {!! Form::open([ 'method'=>'DELETE', 'route' => ['users.destroy', $item->id], 'style' => 'display:none' ]) !!} {!!
                                                                Form::button('
                                                                <span class="glyphicon glyphicon-trash" aria-hidden="true" title="" />', array( 'type' => 'submit', 'class' => '', ));!!}
                                                                {!! Form::close() !!}
                                                                <a href="javascript::void(0);" onclick="if(confirm('You are about to delete a record. This cannot be undone. are you sure?')) $(this).parent().find('form').submit(); else return false;"
                                                                    class="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="feather icon-trash close-card"></i></a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8" class="text-center"> No Record is found! <a href="{{ route('users.create') }}">Click here to add one</a></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
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
    <script type="text/javascript" src="{{ asset('assets/pages/issue-list/issue-list.js') }}"></script>
@endpush
