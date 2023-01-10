<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="../widgets">
                        <i class="ri-dashboard-line" ></i> <span>@lang('translation.dashboards')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('gym_list') }}">
                        <i class="ri-flood-fill" ></i> <span>@lang('translation.gyms')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('plans_list') }}">
                        <i class="ri-clipboard-line" ></i> <span>@lang('translation.plans')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('services_list') }}">
                        <i class="ri-stack-fill" ></i> <span>@lang('translation.services')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('users_list') }}">
                        <i class="ri-group-line" ></i> <span>@lang('translation.users')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('members_list') }}">
                        <i class="ri-team-line" ></i> <span>@lang('translation.members')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('subscriptions_list') }}">
                        <i class="ri-file-list-3-fill" ></i> <span>@lang('translation.subscriptions')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('invioces_list') }}">
                        <i class="ri-folders-line" ></i> <span>@lang('translation.invoices')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('setting') }}">
                        <i class="mdi mdi-cog-outline"></i> <span>@lang('translation.settings')</span>
                    </a>
                </li>

                <!-- end Dashboard Menu -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
