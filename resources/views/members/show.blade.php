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
                        @if($plan)
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
                                    class="d-none d-md-inline-block">Invoices</span>
                            </a>
                        </li>
                    </ul>
                    <div class="flex-shrink-0">
                        <a href="{{ route('members_edit', ['id' => $member->id ]) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                        @if(!$plan)
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
                                @if($plan)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title mb-0">Plan</h5>
                                            </div>

                                        </div>
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{URL::asset('assets/images/plans/'.(file_exists($plan->plan_img) ? $plan->plan_img : 'default.png')  )}}" alt=""
                                                    height="50" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-3 overflow-hidden">
                                                <a href="javascript:void(0);">
                                                    <h6 class="text-truncate fs-14">{{ $plan->plan_name  }}</h6>
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
                        @if($plan)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-3 col-lg-6">
                                        <div class="card pricing-box ribbon-box right">
                                            <div class="card-body bg-light m-2 p-4">
                                                <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="flex-grow-1">
                                                        <h5 class="mb-0 fw-semibold">{{ $plan->plan_name }}</h5>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <h2 class="month mb-0" style="display: block;"><small class="fs-13 text-muted">{{ $plan->amount }} DH/mois</small></h2>
                                                        <h2 class="annual mb-0" style="display: none;"><small class="fs-16"><del>$468</del></small> $351 <small class="fs-13 text-muted">/Year</small></h2>
                                                    </div>
                                                </div>
                                                <p class="text-muted">{{ $plan->plan_details }}</p>
                                                <ul class="list-unstyled vstack gap-3">
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>15</b> Projects
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>Unlimited</b> Customers
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Scalable Bandwidth
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>12</b> FTP Login
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>24/7</b> Support
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-success me-1">
                                                                <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <b>35GB</b> Storage
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 text-danger me-1">
                                                                <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                Domain
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
