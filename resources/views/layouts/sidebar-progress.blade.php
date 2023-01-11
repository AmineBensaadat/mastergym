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
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-line" ></i> <span>@lang('translation.dashboards')</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-building-2-fill" ></i> <span data-key="t-dashboards">@lang('translation.gyms')</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarDashboards" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('gym_list') }}">
                                     @lang('translation.all_gym')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('add_gym') }}">
                                     @lang('translation.add_gym')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarPlans" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPlans">
                        <i class="ri-clipboard-line" ></i> <span data-key="t-dashboards">@lang('translation.plans')</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarPlans" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('plans_list') }}">
                                     @lang('translation.all_plans')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('plans_create') }}">
                                     @lang('translation.add_plan')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarServices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarServices">
                        <i class="ri-stack-fill" ></i> <span data-key="t-dashboards">@lang('translation.services')</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarServices" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('services_list') }}">
                                     @lang('translation.services')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                        <i class="ri-group-line" ></i> <span data-key="t-dashboards">@lang('translation.users')</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarUsers" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('users_list') }}">
                                     @lang('translation.users')
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('users_create') }}">
                                     @lang('translation.add_users')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarMember" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMember">
                        <i class="ri-team-line" ></i> <span data-key="t-dashboards">@lang('translation.members')</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarMember" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('members_list') }}">
                                     @lang('translation.members')
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('members_create') }}">
                                     @lang('translation.add_member')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarSubscriptions" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSubscriptions">
                        <i class="ri-file-list-line" ></i> <span data-key="t-dashboards">@lang('translation.subscriptions')</span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarSubscriptions" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ route('subscriptions_list') }}">
                                     @lang('translation.subscriptions')
                                </a>
                            </li>
                        </ul>
                    </div>
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
