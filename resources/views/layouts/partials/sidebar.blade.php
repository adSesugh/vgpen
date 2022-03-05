<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-menu-user img-radius" src="@if(empty(Auth::user()->photo)) {{ asset('assets/images/avatar-2.jpg') }} @else {{ asset(Auth::user()->photo) }} @endif" alt="User-Profile-Image">
                <div class="user-details">
                    <p id="more-details">{{ str_limit(Auth::user()->name, 15, $end='...') }}<i class="feather icon-chevron-down m-l-10"></i></p>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{ route('users.show', Auth::user()->id) }}">
                            <i class="feather icon-user"></i>Profile
                        </a>
                        <a href="{{ route('changepass', Auth::user()->id) }}">
                            <i class="fa fa-arrows"></i>Change Password
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="feather icon-log-out"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigation-label">MAIN MENU</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('dashboard') ? 'active' : null }}">
                <a href="{{ route('home') }}" class="waves-effect waves-dark">
        			<span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">{{ strtoupper('dashboard') }}</span>
                </a>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('pin-reconciliation') || Request::is('pin_create') ? 'active': null }}">
                <a href="{{ route('pin.recon') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">{{ strtoupper('pin reconciliation') }}</span>
                </a>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('issue-pin') ? 'active': null }}">
                <a href="javascript::void(0);" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">{{ strtoupper('issue pin') }}</span>
                </a>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('pin/*') ? 'active pcoded-trigger' : null }}">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="fa fa-map-pin"></i></span>
                    <span class="pcoded-mtext">{{ strtoupper('pin') }}</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('*/new-pins') ? 'active' : null }}">
                        <a href="{{ route('npin') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">New PINs</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('*/existing-pins') ? 'active' : null }}">
                        <a href="{{ route('epin') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Existing PINs</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('aum/*') ? 'active pcoded-trigger' : null }}">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="fa fa-money"></i></span>
                    <span class="pcoded-mtext">{{ strtoupper('aum') }}</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('*/new-aums') ?'active' : null }}">
                        <a href="{{ route('naum') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">New AUM</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('*/existing-aums') ?'active' : null }}">
                        <a href="{{ route('eaum') }}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Existing AUM</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu {{ Request::is('members/*') ?'active pcoded-trigger' : null }}">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">{{ strtoupper('members') }}</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('*/team-members') ? 'active' : null }}">
                        <a href="{{ route('team.members') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                            <span class="pcoded-mtext">Team</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('*/region-members') ? 'active' : null }}">
                        <a href="{{ route('region.members') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                            <span class="pcoded-mtext">Region</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('*/department-members') ? 'active' : null }}">
                        <a href="{{ route('department.members') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                            <span class="pcoded-mtext">Department</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">{{ strtoupper('benefit applicants') }}</span>
                </a>
            </li>-->
            @if(Auth()->user()->hasRole('hod') || Auth()->user()->hasRole('admin'))
                <li class="pcoded-hasmenu {{ Request::is('admin/*') ?'active pcoded-trigger' : null }}">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="icofont icofont-ui-settings"></i></span>
                        <span class="pcoded-mtext">{{ strtoupper('admin') }}</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ Request::is('*/users') || Request::is('*/users/*') ?'active' : null }}">
                            <a href="{{ route('users.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Users</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('*/teams') || Request::is('*/teams/*') ?'active' : null }}">
                            <a href="{{ route('teams.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Teams</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('*/regions') ||Request::is('*/regions/*') ?'active' : null }}">
                            <a href="{{ route('regions.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Regions</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('*/settings') ||Request::is('*/settings/*') ?'active' : null }}">
                            <a href="{{ route('settings.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Settings</span>
                            </a>
                        </li>
                        <!--<li class="">
                            <a href="menu-header-fixed.html" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Permission</span>
                            </a>
                        </li>-->
                        <li class="{{ Request::is('*/departments') || Request::is('*/departments/*') ?'active' : null }}">
                            <a href="{{ route('departments.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Departments</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
