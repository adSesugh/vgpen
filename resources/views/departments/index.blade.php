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
                            <h4 class="m-b-10">Manage Department</h4>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('home') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Department</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">List</a>
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
                                            <div class="col-md-5">
                                                @if($flag === true)
                                                <form id="main" method="post" action="{{ route('departments.store') }}" novalidate>
                                                    @csrf
                                                    @include('departments.form')
                                                    <div class="form-group row">
                                                        <label class="col-sm-3"></label>
                                                        <div class="col-sm-9 text-right">
                                                            <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                @else {!! Form::model($department, ['route' => ['departments.update', $department->id], 'method' => 'PATCH',
                                                'id' => 'main']) !!}
                                                    @include('departments.form')
                                                    <div class="form-group row">
                                                        <label class="col-sm-3"></label>
                                                        <div class="col-sm-9 text-right">
                                                            <a href="{{ route('departments.index') }}" class="btn btn-primary">Cancel</a>
                                                            <button type="submit" class="btn btn-primary m-b-0">Save Changes</button>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                @endif
                                            </div>
                                            <div class="col-md-7">
                                                <div class="dt-responsive table-responsive">
                                                    <table id="alt-pg-dt" class="table table-striped table-bordered nowrap display">
                                                        <thead>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Department</th>
                                                                <th>Department Head</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($departments as $i => $item)
                                                            <tr>
                                                                <td class="text-center">{{ ++$i }}</td>
                                                                <td>{{ $item->department_name }}</td>
                                                                <td>
                                                                    @if(isset($item->department_head))
                                                                        {{ $item->username($item->id) }}
                                                                    @else
                                                                        <span class="label label-warning">Not Assgined</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('departments.show', $item->id) }}" data-placement="top" data-toggle="tooltip" data-original-title="View Detail"><i class="feather icon-eye close-card"></i></a>
                                                                    <a href="{{ route('departments.edit', $item->id) }}" data-placement="top" data-toggle="tooltip" data-original-title="Edit Record"><i class="feather icon-edit close-card"></i></a>
                                                                    {!! Form::open([ 'method'=>'DELETE', 'route' => ['departments.destroy', $item->id], 'style' =>
                                                                    'display:none' ]) !!} {!! Form::button('
                                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true" title="" />', array( 'type' => 'submit',
                                                                    'class' => '', ));!!} {!! Form::close() !!}
                                                                    <a href="javascript::void(0);" onclick="if(confirm('You are about to delete a record. This cannot be undone. are you sure?')) $(this).parent().find('form').submit(); else return false;"
                                                                        class="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class="feather icon-trash close-card"></i></a>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center"> No Record is found!</td>
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
