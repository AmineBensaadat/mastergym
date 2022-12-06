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
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link"><?php echo app('translator')->get('translation.analytics'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link"><?php echo app('translator')->get('translation.crm'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link"><?php echo app('translator')->get('translation.ecommerce'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link"><?php echo app('translator')->get('translation.crypto'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link"><?php echo app('translator')->get('translation.projects'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft" class="nav-link"> <?php echo app('translator')->get('translation.nft'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span><?php echo app('translator')->get('translation.apps'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar" class="nav-link"><?php echo app('translator')->get('translation.calendar'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat" class="nav-link"><?php echo app('translator')->get('translation.chat'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEmail" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmail">
                                    <?php echo app('translator')->get('translation.email'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEmail">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-mailbox" class="nav-link"><?php echo app('translator')->get('translation.mailbox'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebaremailTemplates" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebaremailTemplates">
                                                <?php echo app('translator')->get('translation.email-templates'); ?>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebaremailTemplates">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="apps-email-basic" class="nav-link"> <?php echo app('translator')->get('translation.basic-action'); ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-email-ecommerce" class="nav-link"> <?php echo app('translator')->get('translation.ecommerce-action'); ?> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce"><?php echo app('translator')->get('translation.ecommerce'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-products" class="nav-link"><?php echo app('translator')->get('translation.products'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-product-details" class="nav-link"><?php echo app('translator')->get('translation.product-Details'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-add-product" class="nav-link"><?php echo app('translator')->get('translation.create-product'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-orders" class="nav-link"><?php echo app('translator')->get('translation.orders'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-order-details" class="nav-link"><?php echo app('translator')->get('translation.order-details'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-customers" class="nav-link"><?php echo app('translator')->get('translation.customers'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-cart" class="nav-link"><?php echo app('translator')->get('translation.shopping-cart'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-checkout" class="nav-link"><?php echo app('translator')->get('translation.checkout'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-sellers" class="nav-link"><?php echo app('translator')->get('translation.sellers'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-seller-details" class="nav-link"><?php echo app('translator')->get('translation.sellers-details'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarProjects" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProjects"><?php echo app('translator')->get('translation.projects'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProjects">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-projects-list" class="nav-link"><?php echo app('translator')->get('translation.list'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-projects-overview" class="nav-link"><?php echo app('translator')->get('translation.overview'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-projects-create" class="nav-link"><?php echo app('translator')->get('translation.create-project'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTasks" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTasks"><?php echo app('translator')->get('translation.tasks'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTasks">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tasks-kanban" class="nav-link"><?php echo app('translator')->get('translation.kanbanboard'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tasks-list-view" class="nav-link"><?php echo app('translator')->get('translation.list-view'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tasks-details" class="nav-link"><?php echo app('translator')->get('translation.task-details'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCRM" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCRM"><?php echo app('translator')->get('translation.crm'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCRM">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crm-contacts" class="nav-link"><?php echo app('translator')->get('translation.contacts'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-companies" class="nav-link"><?php echo app('translator')->get('translation.companies'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-deals" class="nav-link"><?php echo app('translator')->get('translation.deals'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-leads" class="nav-link"><?php echo app('translator')->get('translation.leads'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCrypto" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrypto"><?php echo app('translator')->get('translation.crypto'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCrypto">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crypto-transactions" class="nav-link"><?php echo app('translator')->get('translation.transactions'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-buy-sell" class="nav-link"><?php echo app('translator')->get('translation.buy-sell'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-orders" class="nav-link"><?php echo app('translator')->get('translation.orders'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-wallet" class="nav-link"><?php echo app('translator')->get('translation.my-wallet'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-ico" class="nav-link"><?php echo app('translator')->get('translation.ico-list'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-kyc" class="nav-link"><?php echo app('translator')->get('translation.kyc-application'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarInvoices" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoices"><?php echo app('translator')->get('translation.invoices'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInvoices">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-invoices-list" class="nav-link"><?php echo app('translator')->get('translation.list-view'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-details" class="nav-link"><?php echo app('translator')->get('translation.details'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-create" class="nav-link"><?php echo app('translator')->get('translation.create-invoice'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTickets" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTickets"><?php echo app('translator')->get('translation.supprt-tickets'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTickets">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tickets-list" class="nav-link"><?php echo app('translator')->get('translation.list-view'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tickets-details" class="nav-link"><?php echo app('translator')->get('translation.ticket-details'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarnft" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarnft">
                                    <?php echo app('translator')->get('translation.nft-marketplace'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarnft">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-nft-marketplace" class="nav-link"> <?php echo app('translator')->get('translation.marketplace'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-explore" class="nav-link"> <?php echo app('translator')->get('translation.explore-now'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-auction" class="nav-link"> <?php echo app('translator')->get('translation.live-auction'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-item-details" class="nav-link"> <?php echo app('translator')->get('translation.item-details'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-collections" class="nav-link"> <?php echo app('translator')->get('translation.collections'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-creators" class="nav-link"> <?php echo app('translator')->get('translation.creators'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-ranking" class="nav-link"> <?php echo app('translator')->get('translation.ranking'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-wallet" class="nav-link"> <?php echo app('translator')->get('translation.wallet-connect'); ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-create" class="nav-link"> <?php echo app('translator')->get('translation.create-nft'); ?> </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="apps-file-manager" class="nav-link"> <span><?php echo app('translator')->get('translation.file-manager'); ?></span> <span class="badge badge-pill bg-danger"><?php echo app('translator')->get('translation.new'); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-todo" class="nav-link"> <span><?php echo app('translator')->get('translation.to-do'); ?></span> <span class="badge badge-pill bg-danger"><?php echo app('translator')->get('translation.new'); ?></span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-layout-3-line"></i> <span><?php echo app('translator')->get('translation.layouts'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal" target="_blank" class="nav-link"><?php echo app('translator')->get('translation.horizontal'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached" target="_blank" class="nav-link"><?php echo app('translator')->get('translation.detached'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column" target="_blank" class="nav-link"><?php echo app('translator')->get('translation.two-column'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-vertical-hovered" target="_blank" class="nav-link"><?php echo app('translator')->get('translation.hovered'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->


                <li class="menu-title"><i class="ri-more-fill"></i> <span><?php echo app('translator')->get('translation.pages'); ?></span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span><?php echo app('translator')->get('translation.authentication'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarSignIn" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignIn"><?php echo app('translator')->get('translation.signin'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignIn">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signin-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signin-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarSignUp" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignUp"><?php echo app('translator')->get('translation.signup'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignUp">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signup-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signup-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarResetPass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarResetPass"><?php echo app('translator')->get('translation.password-reset'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarResetPass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarchangePass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarchangePass"><?php echo app('translator')->get('translation.password-create'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarchangePass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-pass-change-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-change-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarLockScreen" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLockScreen"><?php echo app('translator')->get('translation.lock-screen'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarLockScreen">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-lockscreen-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-lockscreen-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarLogout" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLogout"><?php echo app('translator')->get('translation.logout'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarLogout">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-logout-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-logout-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarSuccessMsg" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSuccessMsg"><?php echo app('translator')->get('translation.success-message'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSuccessMsg">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-success-msg-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-success-msg-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTwoStep" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTwoStep"><?php echo app('translator')->get('translation.two-step-verification'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTwoStep">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-twostep-basic" class="nav-link"><?php echo app('translator')->get('translation.basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-twostep-cover" class="nav-link"><?php echo app('translator')->get('translation.cover'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarErrors" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarErrors"><?php echo app('translator')->get('translation.errors'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarErrors">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-404-basic" class="nav-link"><?php echo app('translator')->get('translation.404-basic'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-cover" class="nav-link"><?php echo app('translator')->get('translation.404-cover'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-alt" class="nav-link"><?php echo app('translator')->get('translation.404-alt'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-500" class="nav-link"><?php echo app('translator')->get('translation.500'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-offline" class="nav-link"><?php echo app('translator')->get('translation.offline-page'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-pages-line"></i> <span><?php echo app('translator')->get('translation.pages'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="pages-starter" class="nav-link"><?php echo app('translator')->get('translation.starter'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarProfile" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProfile"><?php echo app('translator')->get('translation.profile'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProfile">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="pages-profile" class="nav-link"><?php echo app('translator')->get('translation.simple-page'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-profile-settings" class="nav-link"><?php echo app('translator')->get('translation.settings'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="pages-team" class="nav-link"><?php echo app('translator')->get('translation.team'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-timeline" class="nav-link"><?php echo app('translator')->get('translation.timeline'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-faqs" class="nav-link"><?php echo app('translator')->get('translation.faqs'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-pricing" class="nav-link"><?php echo app('translator')->get('translation.pricing'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-gallery" class="nav-link"><?php echo app('translator')->get('translation.gallery'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-maintenance" class="nav-link"><?php echo app('translator')->get('translation.maintenance'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-coming-soon" class="nav-link"><?php echo app('translator')->get('translation.coming-soon'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-sitemap" class="nav-link"><?php echo app('translator')->get('translation.sitemap'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-search-results" class="nav-link"><?php echo app('translator')->get('translation.search-results'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-rocket-line"></i> <span><?php echo app('translator')->get('translation.landing'); ?></span>

                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="landing" class="nav-link"> <?php echo app('translator')->get('translation.one-page'); ?> </a>
                            </li>
                            <li class="nav-item">
                                <a href="nft-landing" class="nav-link"> <?php echo app('translator')->get('translation.nft-landing'); ?> </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span><?php echo app('translator')->get('translation.components'); ?></span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
                        <i class="ri-pencil-ruler-2-line"></i> <span><?php echo app('translator')->get('translation.base-ui'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-alerts" class="nav-link"><?php echo app('translator')->get('translation.alerts'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-badges" class="nav-link"><?php echo app('translator')->get('translation.badges'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-buttons" class="nav-link"><?php echo app('translator')->get('translation.buttons'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-colors" class="nav-link"><?php echo app('translator')->get('translation.colors'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-cards" class="nav-link"><?php echo app('translator')->get('translation.cards'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-carousel" class="nav-link"><?php echo app('translator')->get('translation.carousel'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-dropdowns" class="nav-link"><?php echo app('translator')->get('translation.dropdowns'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-grid" class="nav-link"><?php echo app('translator')->get('translation.grid'); ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-images" class="nav-link"><?php echo app('translator')->get('translation.images'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-tabs" class="nav-link"><?php echo app('translator')->get('translation.tabs'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-accordions" class="nav-link"><?php echo app('translator')->get('translation.accordion-collapse'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-modals" class="nav-link"><?php echo app('translator')->get('translation.modals'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-offcanvas" class="nav-link"><?php echo app('translator')->get('translation.offcanvas'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-placeholders" class="nav-link"><?php echo app('translator')->get('translation.placeholders'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-progress" class="nav-link"><?php echo app('translator')->get('translation.progress'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-notifications" class="nav-link"><?php echo app('translator')->get('translation.notifications'); ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-media" class="nav-link"><?php echo app('translator')->get('translation.media-object'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-embed-video" class="nav-link"><?php echo app('translator')->get('translation.embed-video'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-typography" class="nav-link"><?php echo app('translator')->get('translation.typography'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-lists" class="nav-link"><?php echo app('translator')->get('translation.lists'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-general" class="nav-link"><?php echo app('translator')->get('translation.general'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-ribbons" class="nav-link"><?php echo app('translator')->get('translation.ribbons'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-utilities" class="nav-link"><?php echo app('translator')->get('translation.utilities'); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                        <i class="ri-stack-line"></i> <span><?php echo app('translator')->get('translation.advance-ui'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAdvanceUI">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="advance-ui-sweetalerts" class="nav-link"><?php echo app('translator')->get('translation.sweet-alerts'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-nestable" class="nav-link"><?php echo app('translator')->get('translation.nestable-list'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-scrollbar" class="nav-link"><?php echo app('translator')->get('translation.scrollbar'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-animation" class="nav-link"><?php echo app('translator')->get('translation.animation'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-tour" class="nav-link"><?php echo app('translator')->get('translation.tour'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-swiper" class="nav-link"><?php echo app('translator')->get('translation.swiper-slider'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-ratings" class="nav-link"><?php echo app('translator')->get('translation.ratings'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-highlight" class="nav-link"><?php echo app('translator')->get('translation.highlight'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-scrollspy" class="nav-link"><?php echo app('translator')->get('translation.scrollSpy'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets">
                        <i class="ri-honour-line"></i> <span><?php echo app('translator')->get('translation.widgets'); ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                        <i class="ri-file-list-3-line"></i> <span><?php echo app('translator')->get('translation.forms'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarForms">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="forms-elements" class="nav-link"><?php echo app('translator')->get('translation.basic-elements'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-select" class="nav-link"><?php echo app('translator')->get('translation.form-select'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-checkboxs-radios" class="nav-link"><?php echo app('translator')->get('translation.checkboxs-radios'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-pickers" class="nav-link"><?php echo app('translator')->get('translation.pickers'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-masks" class="nav-link"><?php echo app('translator')->get('translation.input-masks'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-advanced" class="nav-link"><?php echo app('translator')->get('translation.advanced'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-range-sliders" class="nav-link"><?php echo app('translator')->get('translation.range-slider'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-validation" class="nav-link"><?php echo app('translator')->get('translation.validation'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-wizard" class="nav-link"><?php echo app('translator')->get('translation.wizard'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-editors" class="nav-link"><?php echo app('translator')->get('translation.editors'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-file-uploads" class="nav-link"><?php echo app('translator')->get('translation.file-uploads'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-layouts" class="nav-link"><?php echo app('translator')->get('translation.form-layouts'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-select2" class="nav-link"><?php echo app('translator')->get('translation.select2'); ?> </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                        <i class="ri-layout-grid-line"></i> <span><?php echo app('translator')->get('translation.tables'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTables">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="tables-basic" class="nav-link"><?php echo app('translator')->get('translation.basic-tables'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-gridjs" class="nav-link"><?php echo app('translator')->get('translation.grid-js'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-listjs" class="nav-link"><?php echo app('translator')->get('translation.list-js'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-datatables" class="nav-link"><?php echo app('translator')->get('translation.datatables'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCharts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCharts">
                        <i class="ri-pie-chart-line"></i> <span><?php echo app('translator')->get('translation.charts'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCharts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarApexcharts" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApexcharts"><?php echo app('translator')->get('translation.apexcharts'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarApexcharts">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="charts-apex-line" class="nav-link"><?php echo app('translator')->get('translation.line'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-area" class="nav-link"><?php echo app('translator')->get('translation.area'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-column" class="nav-link"><?php echo app('translator')->get('translation.column'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bar" class="nav-link"><?php echo app('translator')->get('translation.bar'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-mixed" class="nav-link"><?php echo app('translator')->get('translation.mixed'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-timeline" class="nav-link"><?php echo app('translator')->get('translation.timeline'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-candlestick" class="nav-link"><?php echo app('translator')->get('translation.candlstick'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-boxplot" class="nav-link"><?php echo app('translator')->get('translation.boxplot'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bubble" class="nav-link"><?php echo app('translator')->get('translation.bubble'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-scatter" class="nav-link"><?php echo app('translator')->get('translation.scatter'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-heatmap" class="nav-link"><?php echo app('translator')->get('translation.heatmap'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-treemap" class="nav-link"><?php echo app('translator')->get('translation.treemap'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-pie" class="nav-link"><?php echo app('translator')->get('translation.pie'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radialbar" class="nav-link"><?php echo app('translator')->get('translation.radialbar'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radar" class="nav-link"><?php echo app('translator')->get('translation.radar'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-polar" class="nav-link"><?php echo app('translator')->get('translation.polar-area'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="charts-chartjs" class="nav-link"><?php echo app('translator')->get('translation.chartjs'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="charts-echarts" class="nav-link"><?php echo app('translator')->get('translation.echarts'); ?></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                        <i class="ri-compasses-2-line"></i> <span><?php echo app('translator')->get('translation.icons'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarIcons">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="icons-remix" class="nav-link"><?php echo app('translator')->get('translation.remix'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-boxicons" class="nav-link"><?php echo app('translator')->get('translation.boxicons'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-materialdesign" class="nav-link"><?php echo app('translator')->get('translation.material-design'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-lineawesome" class="nav-link"><?php echo app('translator')->get('translation.line-awesome'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-feather" class="nav-link"><?php echo app('translator')->get('translation.feather'); ?></a>
                            </li>
                             <li class="nav-item">
                                <a href="icons-crypto" class="nav-link"> <span><?php echo app('translator')->get('translation.crypto-svg'); ?></span> <span class="badge badge-pill bg-danger"><?php echo app('translator')->get('translation.new'); ?></span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaps">
                        <i class="ri-map-pin-line"></i> <span><?php echo app('translator')->get('translation.maps'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMaps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="maps-google" class="nav-link">
                                    <?php echo app('translator')->get('translation.google'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="maps-vector" class="nav-link">
                                    <?php echo app('translator')->get('translation.vector'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="maps-leaflet" class="nav-link">
                                    <?php echo app('translator')->get('translation.leaflet'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="ri-share-line"></i> <span><?php echo app('translator')->get('translation.multi-level'); ?></span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link"><?php echo app('translator')->get('translation.level-1.1'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccount"><?php echo app('translator')->get('translation.level-1.2'); ?>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link"><?php echo app('translator')->get('translation.level-2.1'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCrm" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrm"><?php echo app('translator')->get('translation.level-2.2'); ?>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCrm">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link"><?php echo app('translator')->get('translation.level-3.1'); ?></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link"><?php echo app('translator')->get('translation.level-3.2'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH D:\Tarun\Laravel Admins\velzon_laravel\default\Admin\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>