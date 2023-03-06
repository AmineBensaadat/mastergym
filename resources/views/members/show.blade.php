@extends('layouts.master')
@section('title')
    @lang('translation.member')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}">
@endsection
@section('content')
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img style="height: inherit;" src="{{URL::asset('assets/images/members/'.Helper::getImageByEntityId($member->id, "members", "profile") )}}" alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $member->lastname." ".$member->firstname }}</h3>
                    {{-- <p class="text-white-75">Owner & Founder</p> --}}
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ $member->city }}, {{ $member->address }}</div>
                        <div><i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>{{ $member->cin }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            {{-- <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">24.3K</h4>
                            <p class="fs-14 mb-0">Followers</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">1.3K</h4>
                            <p class="fs-14 mb-0">Following</p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--end col-->

        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        @if($subscription)
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#plan" role="tab">
                                <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Plan</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#invoices" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Subscription invoices </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#Pending-Payments" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">@lang('translation.Pending-Payments')</span>
                            </a>
                        </li>
                    </ul>
                    <div class="flex-shrink-0">
                        <a href="{{ route('members_edit', ['id' => $member->id ]) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                        @if(!$subscription)
                        <a href="{{ route('member_subscription_add', ['id' => $member->id ]) }}" class="btn btn-primary"><i class="ri-add-circle-line align-bottom"></i> Add subscription</a>
                        @endif
                    </div>
                    
                    
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">
                                {{-- <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-5">Complete Your Profile</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 30%"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                                <div class="label">30%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Info</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Full Name :</th>
                                                        <td class="text-muted">{{ $member->firstname. " ".$member->lastname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Mobile :</th>
                                                        <td class="text-muted">{{ $member->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">E-mail :</th>
                                                        <td class="text-muted">{{ $member->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Location :</th>
                                                        <td class="text-muted">{{ $member->city }}, {{ $member->address }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Date od birth</th>
                                                        <td class="text-muted">{{ $member->DOB }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->

                                <!--end card-->
                                @if($subscription)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-0">Plan</h5>
                                            </div>

                                        </div>
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{URL::asset('assets/images/plans/'.Helper::getImageByEntityId($subscription->plan_id, "plans", "profile") )}}" alt=""
                                                    height="50" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-3 overflow-hidden">
                                                <a href="javascript:void(0);">
                                                    <h6 class="text-truncate fs-14">{{ $subscription->plan_name  }}</h6>
                                                </a>
                                                {{-- <p class="text-muted mb-0">15 Dec 2021</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div>
                                @endif
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th >@lang('translation.N°')</th>
                                                        <th >@lang('translation.created-at')</th>
                                                        <th >@lang('translation.received')</th>
                                                        <th >@lang('translation.subscription-price')</th>
                                                        <th >@lang('translation.discount')</th>
                                                        <th >@lang('translation.discount-amount')</th>
                                                        <th >@lang('translation.rest')</th>
                                                        <th >@lang('translation.payment-mode')</th>
                                                        <th >@lang('translation.additional-fees')</th>
                                                        <th >@lang('translation.service')</th>
                                                        <th >@lang('translation.plan')</th>
                                                        <th >@lang('translation.comment')</th>
                                                        <th >@lang('translation.action')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoices as $invoice)
                                                    <tr>
                                                        <td>{{ $invoice->id }}</td>
                                                        <td>
                                                            <h4><center><span class="badge badge-outline-info">{{ $invoice->created_at }}</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge badge-soft-success badge-border">{{ $invoice->amount_received }}  @lang('translation.DH')</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge text-bg-secondary bg-dark">{{ $invoice->subscription_price }}  @lang('translation.DH')</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge rounded-pill badge-soft-secondary">{{ $invoice->discount }} %</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge rounded-pill badge-soft-secondary">{{ $invoice->discount_amount }}</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4>
                                                                <center>
                                                                    <span class="badge rounded-pill badge-soft-warning">{{ $invoice->amount_pending }} @lang('translation.DH')</span>
                                                                </center>
                                                            </h4>
                                                        </td>
                                                        <td>
                                                            <h4>
                                                                <center>
                                                                    <span class="badge badge-soft-info badge-border">{{ $invoice->payment_mode }}</span>
                                                                </center>
                                                            </h4>
                                                        </td>
                                                        <td>
                                                            <h4>
                                                                <center><span class="badge badge-soft-info badge-border">{{ $invoice->additional_fees }} @lang('translation.DH')</span></center>
                                                            </h4>
                                                        </td>
                                                        <td><div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img class="img-fluid d-block" alt="" src="{{URL::asset('assets/images/services/'.Helper::getImageByEntityId($invoice->service_id, "services", "profile") )}}">
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $invoice->service_name }}</a></h5>
                                                            </div>
                                                        </div></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                        <img class="img-fluid d-block" alt="" src="{{URL::asset('assets/images/plans/'.Helper::getImageByEntityId($invoice->plan_id, "plans", "profile") )}}">
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $invoice->plan_name }}</a></h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $invoice->payment_comment }}</td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                                                    <a class="text-primary d-inline-block remove-item-btn" data-bs-toggle="modal" href="../../Invoices/download/{{$invoice->id }}" target="_blank">
                                                                        <i class="ri-printer-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                                
                                                        </td>
                                                    </tr>
                                                   
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->


                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="plan" role="tabpanel">
                        @if($subscription)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-3 col-lg-6">
                                        <div class="card pricing-box ribbon-box right">
                                            <div class="card-body bg-light m-2 p-4">
                                                <div class="ribbon-two ribbon-two-danger"><span>{{ $subscription->plan_name }}</span></div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1">
                                                        <h5 class="mb-0 fw-semibold">{{ $subscription->plan_name }}</h5>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <h2 class="month mb-0" style="display: block;"><small class="fs-13 text-muted">{{ $subscription->amount }} DH/mois</small></h2>
                                                    </div>
                                                </div>
                                                <p class="text-muted">{{ $subscription->plan_details }}</p>
                                                <ul class="list-unstyled vstack gap-3">
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>{{ $subscription->days }}</b> Days
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>{!! Helper::dateDiff (date('Y-m-d'),$subscription->end_date) !!}</b> Day Left
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Date end : {{ $subscription->end_date }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Service :  <b>{{ $subscription->service_name }}</b>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="mt-3 pt-2">
                                                    <a href="{{ route('subscriptions_renwe', ['subscription_id' =>  $member->subscription_id, 'member_id' => $member->id ]) }}" class="btn btn-info w-100">Renew</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div>
                        @endif
                        <!--end card-->
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane fade" id="invoices" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h5 class="card-title flex-grow-1 mb-0">Invoices</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th >@lang('translation.N°')</th>
                                                        <th >@lang('translation.created-at')</th>
                                                        <th >@lang('translation.received')</th>
                                                        <th >@lang('translation.subscription-price')</th>
                                                        <th >@lang('translation.discount')</th>
                                                        <th >@lang('translation.discount-amount')</th>
                                                        <th >@lang('translation.rest')</th>
                                                        <th >@lang('translation.payment-mode')</th>
                                                        <th >@lang('translation.additional-fees')</th>
                                                        <th >@lang('translation.service')</th>
                                                        <th >@lang('translation.plan')</th>
                                                        <th >@lang('translation.comment')</th>
                                                        <th >@lang('translation.action')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoices as $invoice)
                                                    <tr>
                                                        <td>{{ $invoice->id }}</td>
                                                        <td>
                                                            <h4><center><span class="badge badge-outline-info">{{ $invoice->created_at }}</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge badge-soft-success badge-border">{{ $invoice->amount_received }}  @lang('translation.DH')</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge text-bg-secondary bg-dark">{{ $invoice->subscription_price }}  @lang('translation.DH')</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge rounded-pill badge-soft-secondary">{{ $invoice->discount }} %</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4><center><span class="badge rounded-pill badge-soft-secondary">{{ $invoice->discount_amount }}</span></center></h4>
                                                        </td>
                                                        <td>
                                                            <h4>
                                                                <center>
                                                                    <span class="badge rounded-pill badge-soft-warning">{{ $invoice->amount_pending }} @lang('translation.DH')</span>
                                                                </center>
                                                            </h4>
                                                        </td>
                                                        <td>
                                                            <h4>
                                                                <center>
                                                                    <span class="badge badge-soft-info badge-border">{{ $invoice->payment_mode }}</span>
                                                                </center>
                                                            </h4>
                                                        </td>
                                                        <td>
                                                            <h4>
                                                                <center><span class="badge badge-soft-info badge-border">{{ $invoice->additional_fees }} @lang('translation.DH')</span></center>
                                                            </h4>
                                                        </td>
                                                        <td><div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img class="img-fluid d-block" alt="" src="{{URL::asset('assets/images/services/'.Helper::getImageByEntityId($invoice->service_id, "services", "profile") )}}">
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $invoice->service_name }}</a></h5>
                                                            </div>
                                                        </div></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                        <img class="img-fluid d-block" alt="" src="{{URL::asset('assets/images/plans/'.Helper::getImageByEntityId($invoice->plan_id, "plans", "profile") )}}">
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $invoice->plan_name }}</a></h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $invoice->payment_comment }}</td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Remove" data-bs-original-title="Remove">
                                                                    <a class="text-primary d-inline-block remove-item-btn" data-bs-toggle="modal" href="../../Invoices/download/{{$invoice->id }}" target="_blank">
                                                                        <i class="ri-printer-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                                
                                                        </td>
                                                    </tr>
                                                   
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end tab-pane-->

                    <div class="tab-pane fade" id="Pending-Payments" role="tabpanel">
                        <div class="row h-100">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                    <i class="ri-money-dollar-circle-fill align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Nombre </p>
                                                <h4 class=" mb-0">$<span class="counter-value" data-target="2390.68">2,390.68</span></h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end">
                                                <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>6.24 %<span> </span></span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                                    <i class="ri-arrow-up-circle-fill align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> Total Change</p>
                                                <h4 class=" mb-0">$<span class="counter-value" data-target="19523.25">19,523.25</span></h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-end">
                                                <span class="badge badge-soft-success"><i class="ri-arrow-up-s-fill align-middle me-1"></i>3.67 %<span> </span></span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">My Currencies</h4>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-soft-primary btn-sm">24H</button>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="btn btn-soft-primary btn-sm" role="button" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Get Report<i class="mdi mdi-chevron-down align-middle ms-1"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Download Report</a>
                                                    <a class="dropdown-item" href="#">Export</a>
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-borderless table-centered align-middle table-nowrap mb-0">
                                                <thead class="text-muted bg-soft-light">
                                                    <tr>
                                                        <th>Coin Name</th>
                                                        <th>Price</th>
                                                        <th>24h Change</th>
                                                        <th>Total Balance</th>
                                                        <th>Total Coin</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead><!-- end thead -->
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/btc.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Bitcoin</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$48,568.025</td>
                                                        <td>
                                                            <h6 class="text-success fs-13 mb-0"><i class="mdi mdi-trending-up align-middle me-1"></i>5.26 </h6>
                                                        </td>
                                                        <td>$53,914.025</td>
                                                        <td>1.25634801</td>
                                                        <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/ltc.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Litecoin</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$87,142.027</td>
                                                        <td>
                                                            <h6 class="text-danger fs-13 mb-0"><i class="mdi mdi-trending-down align-middle me-1"></i>3.07 </h6>
                                                        </td>
                                                        <td>$75,854.127</td>
                                                        <td>2.85472161</td>
                                                           <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/eth.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Eathereum</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$33,847.961</td>
                                                        <td>
                                                          <h6 class="text-success fs-13 mb-0"><i class="mdi mdi-trending-up align-middle me-1"></i>7.13 </h6>
                                                        </td>
                                                        <td>$44,152.185</td>
                                                        <td>1.45612347</td>
                                                          <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/bnb.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Binance</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$73,654.421</td>
                                                        <td>
                                                            <h6 class="text-success fs-13 mb-0"><i class="mdi mdi-trending-up align-middle me-1"></i>0.97</h6>
                                                        </td>
                                                        <td>$48,367.125</td>
                                                        <td>0.35734601</td>
                                                        <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/usdt.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Tether</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$66,742.077</td>
                                                        <td>
                                                            <h6 class="text-danger fs-13 mb-0"><i class="mdi mdi-trending-down align-middle me-1"></i>1.08 </h6>
                                                        </td>
                                                        <td>$53,487.083</td>
                                                        <td>3.62912570</td>
                                                        <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/dash.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Dash</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$34,736.209</td>
                                                        <td>
                                                            <h6 class="text-success fs-13 mb-0"><i class="mdi mdi-trending-up align-middle me-1"></i>4.52 </h6>
                                                        </td>
                                                        <td>$15,203.347</td>
                                                        <td>1.85412740</td>
                                                        <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/neo.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Neo</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$56,357.313</td>
                                                        <td>
                                                            <h6 class="text-danger fs-13 mb-0"><i class="mdi mdi-trending-down align-middle me-1"></i>2.87 </h6>
                                                        </td>
                                                        <td>$61,843.173</td>
                                                        <td>1.87732061</td>
                                                        <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-2">
                                                                    <img src="assets/images/svg/crypto-icons/doge.svg" alt="" class="avatar-xxs">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fs-14 mb-0">Dogecoin</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$62,357.649</td>
                                                        <td>
                                                            <h6 class="text-success fs-13 mb-0"><i class="mdi mdi-trending-up align-middle me-1"></i>3.45 </h6>
                                                        </td>
                                                        <td>$54,843.173</td>
                                                        <td>0.95632087</td>
                                                        <td><a href="apps-crypto-buy-sell.html" class="btn btn-sm btn-soft-secondary">Trade</a></td>
                                                    </tr><!-- end -->
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div><!-- end tbody -->
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
    
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header align-items-center border-0 d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Payment</h4>
                                    </div><!-- end cardheader -->
                                    <div class="card-body p-0">
                                        <div class="tab-content p-0">
                                            <div class="tab-pane active" id="buy-tab" role="tabpanel">
                                                <div class="p-3 bg-soft-warning">
                                                    <div class="float-end ms-2">
                                                        <h6> <span class="text-dark">12,426.07</span> </h6>
                                                    </div>
                                                    <h6 class="mb-0 text-danger">Total</h6>
                                                </div>
                                                <div class="p-3">
                                                    <div>
                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text">Amount</label>
                                                            <input type="text" class="form-control" placeholder="0">
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 pt-2">
                                                        <div class="d-flex mb-2">
                                                            <div class="flex-grow-1">
                                                                <p class="fs-13 mb-0">Amount received</p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <h6 class="mb-0">0</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 pt-2">
                                                        <button type="button" class="btn btn-primary w-100">Pay</button>
                                                    </div>
                                                </div>
                                            </div><!-- end tabpane -->
                                        </div><!-- end tab pane -->
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div>
                    </div>
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
