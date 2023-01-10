<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-light.png')); ?>" alt="" height="17">
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
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="../widgets">
                        <i class="ri-dashboard-line" ></i> <span><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-building-2-fill" ></i> <span data-key="t-dashboards"><?php echo app('translator')->get('translation.gyms'); ?></span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarDashboards" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('gym_list')); ?>">
                                     <?php echo app('translator')->get('translation.all_gym'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('add_gym')); ?>">
                                     <?php echo app('translator')->get('translation.add_gym'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarPlans" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPlans">
                        <i class="ri-clipboard-line" ></i> <span data-key="t-dashboards"><?php echo app('translator')->get('translation.plans'); ?></span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarPlans" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('plans_list')); ?>">
                                     <?php echo app('translator')->get('translation.all_plans'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('plans_create')); ?>">
                                     <?php echo app('translator')->get('translation.add_plan'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarServices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarServices">
                        <i class="ri-stack-fill" ></i> <span data-key="t-dashboards"><?php echo app('translator')->get('translation.services'); ?></span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarServices" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('services_list')); ?>">
                                     <?php echo app('translator')->get('translation.services'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                        <i class="ri-stack-fill" ></i> <span data-key="t-dashboards"><?php echo app('translator')->get('translation.users'); ?></span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarUsers" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('users_list')); ?>">
                                     <?php echo app('translator')->get('translation.users'); ?>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('users_create')); ?>">
                                     <?php echo app('translator')->get('translation.add_users'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarMember" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMember">
                        <i class="ri-stack-fill" ></i> <span data-key="t-dashboards"><?php echo app('translator')->get('translation.members'); ?></span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarMember" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('members_list')); ?>">
                                     <?php echo app('translator')->get('translation.members'); ?>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('members_create')); ?>">
                                     <?php echo app('translator')->get('translation.add_member'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarSubscriptions" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSubscriptions">
                        <i class="ri-stack-fill" ></i> <span data-key="t-dashboards"><?php echo app('translator')->get('².subscriptions'); ?></span>
                    </a>
                    <div class="menu-dropdown collapse" id="sidebarSubscriptions" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo e(route('subscriptions_list')); ?>">
                                     <?php echo app('translator')->get('translation.subscriptions'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('invioces_list')); ?>">
                        <i class="ri-folders-line" ></i> <span><?php echo app('translator')->get('translation.invoices'); ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('setting')); ?>">
                        <i class="mdi mdi-cog-outline"></i> <span><?php echo app('translator')->get('translation.settings'); ?></span>
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
<?php /**PATH C:\projects\default\resources\views/layouts/sidebar-progress.blade.php ENDPATH**/ ?>