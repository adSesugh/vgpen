<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title') | {{ config('app.name', 'Veritas Glanvillus Pensions') }}</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Favicon icon -->
      <link rel="icon" href="{{URL::to('assets/images/favicon.ico')}}" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/bower_components/bootstrap/css/bootstrap.min.css') }}">
      <!-- waves.css -->
      <link rel="stylesheet" href="{{URL::to('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
      <!-- feather icon -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/feather/css/feather.css')}}">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/icofont/css/icofont.css')}}">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!--Style.css-->
    <link rel="stylesheet"type="text/css"href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet"type="text/css"href="{{ asset('assets/css/pages.css')}}">
</head>

<body themebg-pattern="@if(route('login')) theme6 @else theme1 @endif">
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header" header-theme="theme1">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a href="{{URL::to('/')}}">
                            <img class="img-fluid" src="{{ URL::to('assets/images/veritas.png') }}" alt="Logo" />
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Menu header end -->
        <section class="login-block">
            <!-- Container-fluid starts -->

            <div class="container-fluid">
                @yield('auth-content')
                <!-- end of row -->
            </div>
            <!-- end of container-fluid -->

        </section>
    </div>


    <div class="footer">
        <p class="text-center m-b-0">Copyright &copy; {{date('Y')}} Veritas Pensions , All rights reserved.</p>
    </div>

    <script type="text/javascript" src="{{asset('assets/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/bower_components/popper.js/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- waves js -->
    <script src="{{asset('assets/pages/waves/js/waves.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('assets/bower_components/modernizr/js/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('assets/js/common-pages.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pcoded.min.js')}}"></script>

</body>
</html>
