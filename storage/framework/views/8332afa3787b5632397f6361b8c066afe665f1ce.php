<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(URL::asset('assets/images/logo-dark.png')); ?>" alt="" height="17">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo e(URL::asset('assets/images/logo-light.png')); ?>" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-buildings fs-22'></i>
                        <span
                            class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info"><?php echo e((Helper::getAllGymByAccountId())->count()); ?></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart"
                        aria-labelledby="page-header-cart-dropdown">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> My Gyms</h6>
                                </div>
                                <div class="col-auto">
                                    <span class="badge badge-soft-warning fs-13"><span class="cartitem-badge"><?php echo e((Helper::getAllGymByAccountId())->count()); ?></span>
                                        gyms</span>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 300px;">
                            <div class="p-2">
                                <?php $__currentLoopData = Helper::getAllGymByAccountId(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gym): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo e(URL::asset('assets/images/gyms/'.Helper::getImageByEntityId($gym->id, "gyms", "profile") )); ?>" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="<?php echo e(route('show_gym', ['id' => $gym->id ])); ?>" class="text-reset"><?php echo e($gym->name); ?></a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                <?php echo e($gym->desc); ?>

                                            </p>
                                        </div>
                                                <div class="ps-2">
                                                    <?php if( $gym->id == Auth::user()->default_gym_id): ?>
                                                        <span class="badge badge-soft-success badge-border">Active</span>
                                                    <?php else: ?>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input select_gym" gym_id="<?php echo e($gym->id); ?>" type="checkbox" role="switch" id="flexSwitchCheckDisabled" >
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <?php switch(Session::get('lang')):
                        
                        case ('en'): ?>
                            <img src="<?php echo e(URL::asset('/assets/images/flags/en.svg')); ?>" class="rounded" alt="Header Language" height="20">
                        <?php break; ?>
                        <?php case ('fr'): ?>
                            <img src="<?php echo e(URL::asset('/assets/images/flags/fr.svg')); ?>" class="rounded" alt="Header Language"
                                height="20">
                        <?php break; ?>
                        <?php case ('ar'): ?>
                            <img src="<?php echo e(URL::asset('/assets/images/flags/ma.svg')); ?>" class="rounded" alt="Header Language"
                                height="20">
                        <?php break; ?>
                        <?php default: ?>
                            <img src="<?php echo e(URL::asset('/assets/images/flags/en.svg')); ?>" class="rounded" alt="Header Language" height="20">
                    <?php endswitch; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">

                        <!-- item-->
                        <a href="<?php echo e(url('index/en')); ?>" class="dropdown-item notify-item language py-2" data-lang="en"
                            title="English">
                            <img src="<?php echo e(URL::asset('assets/images/flags/en.svg')); ?>" alt="user-image" class="me-2 rounded" height="20">
                            <span class="align-middle">English</span>
                        </a>

                        <!-- item-->
                        <a href="<?php echo e(url('index/fr')); ?>" class="dropdown-item notify-item language" data-lang="fr"
                            title="French">
                            <img src="<?php echo e(URL::asset('assets/images/flags/fr.svg')); ?>" alt="user-image" class="me-2 rounded" height="20">
                            <span class="align-middle">français</span>
                        </a>

                          <!-- item-->
                          <a href="<?php echo e(url('index/ar')); ?>" class="dropdown-item notify-item language" data-lang="ar"
                            title="Arabic">
                            <img src="<?php echo e(URL::asset('assets/images/flags/ma.svg')); ?>" alt="user-image" class="me-2 rounded" height="20">
                            <span class="align-middle">arabic</span>
                        </a>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?php echo e(URL::asset('assets/images/users/'.Helper::getImageByEntityId(Auth::user()->id, "users", "profile") )); ?>"
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(Auth::user()->name); ?></span>
                                
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header"><?php echo e(Auth::user()->name); ?></h6>
                        <a class="dropdown-item" href="<?php echo e(route('setting')); ?>"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span></a>
                   
                    
              
                        <div class="dropdown-divider"></div>
              
                        <a class="dropdown-item" href="<?php echo e(route('setting')); ?>">
                                <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> 
                                <span class="align-middle">Settings</span>
                        </a>
                     
                        <a class="dropdown-item " href="javascript:void();"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="bx bx-power-off font-size-16 align-middle me-1"></i> <span
                                key="t-logout"><?php echo app('translator')->get('translation.logout'); ?></span></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\projects\default\resources\views/layouts/topbar.blade.php ENDPATH**/ ?>