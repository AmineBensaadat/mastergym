@extends('layouts.master')
@section('title')
    @lang('translation.member')
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
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
                    <input id="member_id" type="hidden" class="form-control" value="{{ $member->id }}">
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
                                    class="d-none d-md-inline-block">@lang('translation.overview')</span>
                            </a>
                        </li>
                        @if($subscription)
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#plan" role="tab">
                                <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">@lang('translation.plan')</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#invoices" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">@lang('translation.invoice-subscription') </span>
                            </a>
                        </li>

                        <li class="nav-item pending_paiment_tab">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#Pending-Payments" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">@lang('translation.Pending-Payments')</span>
                            </a>
                        </li>
                    </ul>
                    <div class="flex-shrink-0">
                        <a href="{{ route('members_edit', ['id' => $member->id ]) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> @lang('translation.edit-Profile') </a>
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
                                                        <th class="ps-0" scope="row"> @lang('translation.full-name') :</th>
                                                        <td class="text-muted">{{ $member->firstname. " ".$member->lastname }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">@lang('translation.phone') :</th>
                                                        <td class="text-muted">{{ $member->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">@lang('translation.email') :</th>
                                                        <td class="text-muted">{{ $member->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">@lang('translation.address') :</th>
                                                        <td class="text-muted">{{ $member->city }}, {{ $member->address }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">@lang('translation.day') :</th>
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
                                                <h5 class="card-title mb-0">@lang('translation.plan')</h5>
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
                                                        <th >@lang('translation.Service')</th>
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
                                    <h5 class="card-title flex-grow-1 mb-0">@lang('translation.invoice') </h5>
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
                                                        <th >@lang('translation.Service')</th>
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
                                                    <i class="ri-file-list-line align-middle"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> @lang('translation.subscriptions')  </p>
                                                <h4 class=" mb-0"><span class="counter-value" data-target="{{ (Helper::countSubscriptionsPendingPayment($member->id)) }}"></span></h4>
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
                                                <p class="text-uppercase fw-semibold fs-12 text-muted mb-1"> @lang('translation.amount-pending')  :</p>
                                                <h4 class=" mb-0"><span class="counter-value" data-target="{{ (Helper::countTotalPendingPayment($member->id)) }}"></span> DH</h4>
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
                                        <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" href="#">Download Report</a>
                                                    <a class="dropdown-item" href="#">Export</a>
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="pending_paiment_dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th >@lang('translation.member')</th>
                                                    <th >@lang('translation.Pending-Payments')</th>
                                                    <th >@lang('translation.services')</th>
                                                    <th >@lang('translation.action')</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
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
    <script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $( ".pending_paiment_tab" ).click(function() {

                    $('#pending_paiment_dt').DataTable().ajax.reload();

            });
            var member_id = $("#member_id").val();

             var dataTablePendingPaimentMembers = $('#pending_paiment_dt').DataTable({
                        "processing" : true,
                        "fixedHeader":true,
                        "bLengthChange": false,
                        "serverSide" : true,
                        "order" : [],
                        "autoWidth":true,
                        "scrollX": true,
                        "searching" : false,
                        "ajax" : {
                        url:"../../members/getPendingPaimentByMember",
                        type:"POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            global_filter:'',
                            filter_firstname:'',
                            filter_lastname:'',
                            filter_cin:'',
                            filter_phone:'',
                            filter_address:'',
                            filter_city:'',
                            filter_service:'',
                            filter_plans:'',
                            gymId:'',
                            member_id: member_id
                        }
                        }
                    });

            $('#pending_paiment_dt tbody').on( 'click', '.pay_bill', function () {
                    alert( "Handler for .click() called." );
            } );

        });
    </script>
@endsection
