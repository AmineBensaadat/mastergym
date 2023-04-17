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

                @can('dashboard-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                            <i class="ri-dashboard-line" ></i> <span>@lang('translation.dashboards')</span>
                        </a>
                    </li>
                @endcan

                @can('role-create')
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarMember" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMember">
                            <i class="ri-team-line" ></i> <span data-key="t-dashboards">@lang('translation.members')</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarMember" style="">
                            <ul class="nav nav-sm flex-column">
                                @can('member-all-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('members_list') }}">
                                            @lang('translation.all-members')
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('member-expired-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('members_expired') }}">
                                            <span data-key="t-layouts">@lang('translation.Expired')</span> <span class="badge badge-pill bg-danger" data-key="t-hot">{{ Helper::countMembersByStatus('expired')  }}</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('member-create-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('members_create') }}">
                                            @lang('translation.add')@lang('translation.member')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('coach-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarCoach" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMember">
                            <i class="ri-team-line" ></i> <span data-key="t-dashboards">@lang('translation.coach')</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarCoach" style="">
                            <ul class="nav nav-sm flex-column">
                                @can('coach-all-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('coach_list') }}">
                                            @lang('translation.all-coachs')
                                        </a>
                                    </li>
                                @endcan

                                @can('coach-create-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('coach_create') }}">
                                            @lang('translation.add')@lang('translation.coach')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('gym-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="ri-building-2-fill" ></i> <span data-key="t-dashboards">@lang('translation.gyms')</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarDashboards" style="">
                            <ul class="nav nav-sm flex-column">
                                @can('gym-all-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('gym_list') }}">
                                            @lang('translation.all_gym')
                                        </a>
                                    </li>
                                @endcan    

                                @can('gym-create-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('add_gym') }}">
                                            @lang('translation.add_gym')@lang('translation.gym')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('plans-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarPlans" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPlans">
                            <i class="ri-clipboard-line" ></i> <span data-key="t-dashboards">@lang('translation.plans')</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarPlans" style="">
                            <ul class="nav nav-sm flex-column">
                                @can('plans-all-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('plans_list') }}">
                                            @lang('translation.plans')
                                        </a>
                                    </li>
                                @endcan

                                @can('plans-create-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('plans_create') }}">
                                            @lang('translation.CREATE_PLAN')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('services-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarServices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarServices">
                            <i class="ri-stack-fill" ></i> <span data-key="t-dashboards">@lang('translation.services')</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarServices" style="">
                            <ul class="nav nav-sm flex-column">
                                @can('services-all-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('services_list') }}">
                                            @lang('translation.services')
                                        </a>
                                    </li>
                                @endcan

                                @can('services-create-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('services_add') }}">
                                            @lang('translation.add-services')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('users-nav')        
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                            <i class="ri-group-line" ></i> <span data-key="t-dashboards">@lang('translation.users')</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarUsers" style="">
                            <ul class="nav nav-sm flex-column">
                                @can('users-all-menu') 
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('users_list') }}">
                                            @lang('translation.users')
                                        </a>
                                    </li>
                                @endcan

                                @can('role-list-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('roles_list') }}">
                                            @lang('translation.roles')
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('users-create-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('users_create') }}">
                                            @lang('translation.Create-user')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('subscriptions-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link collapsed" href="#sidebarSubscriptions" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSubscriptions">
                            <i class="ri-file-list-line" ></i> <span data-key="t-dashboards">@lang('translation.subscriptions')</span>
                        </a>
                        <div class="menu-dropdown collapse" id="sidebarSubscriptions" style="">
                            <ul class="nav nav-sm flex-column">
                                @can('subscriptions-all-menu')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="{{ route('subscriptions_list') }}">
                                            @lang('translation.subscriptions')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('invoices-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('invioces_list') }}">
                            <i class="ri-folders-line" ></i> <span>@lang('translation.invoices')</span>
                        </a>
                    </li>
                @endcan
                
                @can('setting-nav')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('setting') }}">
                            <i class="mdi mdi-cog-outline"></i> <span>@lang('translation.settings')</span>
                        </a>
                    </li>
                @endcan

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
