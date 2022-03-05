@extends('layouts.app')
@section('title') Existing PIN 
@endsection

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">Existing PIN</h4>
                    </div>
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
                                        <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Existing Business for {{ Auth::user()->name }}</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="dt-responsive table-responsive">
                                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th>Upload Date</th>
                                                                    <th>PIN</th>
                                                                    <th>Employee</th>
                                                                    <th>Employer</th>
                                                                    <th>Employer RegNo.</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($pins as $i => $item)
                                                                <tr>
                                                                <td>{{ date('d-m-Y', strtotime($item->UPLOAD_DATE)) }}</td>
                                                                    <td>{{ $item->PIN }}</td>
                                                                    <td>{{ $item->SURNAME }} {{ $item->FIRSTNAME }} @if($item->OTHERNAMES) {{ $item->OTHERNAMES }} @endif</td>
                                                                    <td>{{ $item->EMPLOYER_NAME }}</td>
                                                                    <td>{{ $item->EMPLOYER_RCNO }}</td>
                                                                </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="6" class="text-center">Record Not found!</td>
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

@endpush
