@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Dashboard</h4>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('home') }}">
                                    <i class="feather icon-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#!">Dashboard</a>
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
                    <div class="page-body">
                        <!-- [ page content ] start -->
                        @if(Auth::user()->hasRole('admin'))
                            <div class="row">
                            </div>
                        @else
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                    <h5>PIN PERFORMANCE</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>NORMAL PIN</h5>
                                                                </div>
                                                                <div class="card-block">
                                                                    <canvas id="polarChart" width="400" height="400"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>NEW BUSINESS</h5>
                                                                </div>
                                                                <div class="card-block">
                                                                    <canvas id="polarChart1" width="400" height="400"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                    <h5>AUM PERFORMANCE</h5>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>NORMAL AUM</h5>
                                                                </div>
                                                                <div class="card-block">
                                                                    <canvas id="polarChart2" width="400" height="400"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>AUM NEW BUSINESS</h5>
                                                                </div>
                                                                <div class="card-block">
                                                                    <canvas id="polarChart3" width="400" height="400"></canvas>
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
                            <!-- [ page content ] end -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Top 10 Contributions</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="dt-responsive table-responsive">
                                                <table id="order-table" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Agent</th>
                                                            <th>PIN</th>
                                                            <th>Employer</th>
                                                            <th>Employer RegNo.</th>
                                                            <th>Contribution</th>
                                                            <th>Contribution Date</th>
                                                            <th>Value Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($top_aums as $i => $item)
                                                            <tr>
                                                                <td>{{ $item->AGENT_CODE }}</td>
                                                                <td>{{ $item->PIN }}</td>
                                                                <td>{{ $item->EMPLOYER_NAME }}</td>
                                                                <td>{{ $item->EMPLOYER_RCNO }}</td>
                                                                <td>&#8358;{{ number_format($item->TOTAL_CONTRIBUTION,2,'.',',') }}</td>
                                                                <td>{{ date('d-m-Y', strtotime($item->CONTRIBUTION_DATE)) }}</td>
                                                                <td>{{ date('d-m-Y', strtotime($item->VALUE_DATE)) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="8" class="text-center">Record Not found!</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Top 10 Benefit Applicants</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="dt-responsive table-responsive">
                                                <table id="order-table2" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Applicant</th>
                                                            <th>Employer</th>
                                                            <th>Employer No.</th>
                                                            <th>Contribution</th>
                                                            <th>Applied Amount</th>
                                                            <th>Applied date</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Tiger Nixon</td>
                                                            <td>System Architectz</td>
                                                            <td>90884</td>
                                                            <td>$320,800</td>
                                                            <td>$30,800</td>
                                                            <td>2011/04/25</td>
                                                            <td>Approved</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Garrett Winters</td>
                                                            <td>Accountant Consulting</td>
                                                            <td>90884</td>
                                                            <td>$300,800</td>
                                                            <td>$50,800</td>
                                                            <td>2011/03/25</td>
                                                            <td>Pending</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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
    <script type="text/javascript" src="{{ asset('assets/pages/widget/excanvas.js') }}"></script>
    <!-- amchart js -->
    <script src="{{ asset('assets/pages/widget/amchart/gauge.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/Chart.min.js') }}"></script>

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

    @if(!Auth::user()->hasRole('admin'))
        <script type="text/javascript">
            "use strict";
            $(document).ready(function(){
                var polarElem = document.getElementById("polarChart").getContext('2d');

                var data3 = {
                    datasets: [{
                        data: {{ $normal_target }},
                        backgroundColor: [
                            "#49b01c",
                            "#4d575c"
                        ]
                    }],
                    labels: [
                        "Acheived",
                        "Expected"
                    ]
                };

                new Chart(polarElem, {
                    data: data3,
                    type: 'polarArea',
                    options: {
                        scale: {
                            display: false
                        },
                        legend: {
                            display: false,
                            position:'bottom',
                        },
                        title: {
                            display: true,
                            text: "Expected: {{ $normal_pins_target }}  Achieved: {{ $normal_pins_achieved }} Variance: {{ $variance_pin }}",
                            position: "bottom",
                            fontColor: '#0e0f0f',
                            fontStyle: 'bold',
                            fontSize: '20'
                        },
                        elements: {
                            arc: {
                                borderColor: ""
                            }
                        }
                    }
                });

                var polarElem = document.getElementById("polarChart1");

                var data3 = {
                    datasets: [{
                        data: {{ $newBusinessPin }},
                        backgroundColor: [
                            "#4d575c",
                            "#49b01c"
                        ]
                    }],
                    labels: [
                        "Expected",
                        "Achieved"
                    ]
                };

                new Chart(polarElem, {
                    data: data3,
                    type: 'polarArea',
                    options: {
                        scale: {
                            display: false
                        },
                        legend: {
                            display: false,
                            position:'bottom',
                        },
                        title: {
                            display: true,
                            text: "Expected: {{ $new_business_pins }}  Achieved: {{ $new_business_record }}  Variance: {{ $variance_biz }}",
                            position: "bottom",
                            fontColor: '#0e0f0f',
                            fontStyle: 'bold',
                            fontSize: '20'
                        },
                        elements: {
                            arc: {
                                borderColor: ""
                            }
                        }
                    }
                });

                var polarElem = document.getElementById("polarChart2");

                var data3 = {
                    datasets: [{
                        data: {{ $finExisting }},
                        backgroundColor: [
                            "#49b01c",
                            "#4d575c"
                        ]
                    }],
                    labels: [
                        "Achieved",
                        "Expected"
                    ]
                };

                new Chart(polarElem, {
                    data: data3,
                    type: 'polarArea',
                    options: {
                        scale: {
                            display: false
                        },
                        legend: {
                            display: false,
                            position:'bottom',
                        },
                        title: {
                            display: true,
                            text: "E: \u20A6{{ number_format($financial_existing_target) }}  A: \u20A6{{ number_format($financial_existing) }} V: \u20A6{{ number_format($variance_aum_ex) }}",
                            position: "bottom",
                            fontColor: '#0e0f0f',
                            fontStyle: 'bold',
                            fontSize: '20'
                        },
                        elements: {
                            arc: {
                                borderColor: ""
                            }
                        }
                    }
                });

                var polarElem = document.getElementById("polarChart3");

                var data3 = {
                    datasets: [{
                        data: {{ $finNewBiz }},
                        backgroundColor: [
                            "#4d575c",
                            "#49b01c"
                        ]
                    }],
                    labels: [
                        "Expected",
                        "Achieved"
                    ]
                };

                new Chart(polarElem, {
                    data: data3,
                    type: 'polarArea',
                    options: {
                        scale: {
                            display: false
                        },
                        legend: {
                            display: false,
                            position:'bottom',
                        },
                        title: {
                            display: true,
                            text: "E: \u20A6{{ number_format($financial_new_target) }} A: \u20A6{{ number_format($financial_new_buiness)}}  V: \u20A6{{ number_format($variance_new_aum) }}",
                            position: "bottom",
                            fontColor: '#0e0f0f',
                            fontStyle: 'bold',
                            fontSize: '20'
                        },
                        elements: {
                            arc: {
                                borderColor: ""
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endpush
