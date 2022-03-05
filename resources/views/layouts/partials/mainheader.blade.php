<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                <i class="feather icon-toggle-right"></i>
            </a>
            <a href="index.html">
                <img class="img-fluid" src="{{ URL::to('assets/images/veritas.png') }}" alt="PFA" />
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
                    <form method="POST" action="">
                        <div class="main-search morphsearch-search">
                            <div class="input-group">
                                    <span class="input-group-prepend search-close">
                                    <i class="feather icon-x input-group-text"></i>
                                </span>
                                <input type="text" name="employee_pin" class="form-control" placeholder="Enter Keyword">
                                <span class="input-group-append search-btn">
                                    <i class="feather icon-search input-group-text"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                        <i class="full-screen feather icon-maximize"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="@if(empty(Auth::user()->photo)) {{ asset('assets/images/avatar-2.jpg') }} @else {{ asset(Auth::user()->photo) }} @endif" class="img-radius" alt="User-Profile-Image">
                            <span>{{ str_limit(Auth::user()->name, 15, $end='...') }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="{{ route('users.show', Auth::user()->id) }}">
                                    <i class="feather icon-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('changepass', Auth::user()->id) }}">
                                    <i class="fa fa-arrows"></i> Change Password
                                </a>
                            </li>
                            <!--
                            <li>
                                <a href="auth-lock-screen.html">
                                    <i class="feather icon-lock"></i> Lock Screen
                                </a>
                            </li>-->
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
