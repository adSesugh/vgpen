@extends('layouts.app')
@section('title') PIN Reconciliation
@endsection

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Manage PIN Reconciliation</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('home') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">PIN Reconciliation</a>
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
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>PIN</th>
                                                    <th>Employee</th>
                                                    <th>Employer</th>
                                                    <th>Employer Rec. No.</th>
                                                    <th>Staff ID</th>
                                                    @if(Auth::user()->hasRole('hod'))
                                                        <th>Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pin_rec as $i => $item)
                                                <tr>
                                                    <td class="txt-primary">{{ ++$i }}</td>
                                                    <td>{{ $item->PIN }}</td>
                                                    <td>{{ $item->SURNAME }}, {{ $item->FIRSTNAME }} @if(isset($item->OTHERNAMES)) {{ $item->OTHERNAMES }} @endif</td>
                                                    <td>{{ $item->EMPLOYER_NAME }}</td>
                                                    <td>{{ $item->EMPLOYER_RCNO }}</td>
                                                    <td>{{ $item->AGENT_CODE }}</td>
                                                    @if(Auth::user()->hasRole('hod'))
                                                        <td class="text-center">
                                                            <a href="{{ route('pfa.create', 'agent_code='.$item->agent_code) }}" data-placement="top" data-toggle="tooltip" data-original-title="Register Marketer"><i class="icofont icofont-reply"></i></a>
                                                        </td>
                                                    @endif
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center"> No Record is found!</td>
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
