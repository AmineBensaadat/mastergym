@extends('layouts.master')
@section('title') @lang('translation.team') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.pages') @endslot
@slot('title') @lang('translation.subscriptions') @endslot
@endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/custom_subscription.css') }}" rel="stylesheet" type="text/css" />



<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>@lang('translation.member')</th>
                            <th>@lang('translation.services')</th>
                            <th>@lang('translation.plans')</th>
                            <th>@lang('translation.start-date')</th>
                            <th>@lang('translation.end-date')</th>
                            <th>@lang('translation.rest')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div>
                                            <img class="image avatar-xs rounded-circle" alt="" src="{{URL::asset(Helper::getImageByEntityId($subscription->member_id, "members", "profile") ) }} ">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2 name">
                                        <a href="../members/show/{{ $subscription->member_id }}">
                                            {{ $subscription->lastname." ".$subscription->firstname }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                        <img class="img-fluid d-block" alt="" src="{{URL::asset(Helper::getImageByEntityId($subscription->service_id, "services", "profile", "profile") )}}">
                                    </div>
                                    <div>
                                        <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $subscription->service_name }}</a></h5>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                        <img class="img-fluid d-block" alt="" src="{{URL::asset(Helper::getImageByEntityId($subscription->plan_id, "plans", "profile", "profile") )}}">
                                    </div>
                                    <div>
                                        <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $subscription->plan_name }}</a></h5>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                    <i class="ri-map-pin-time-line label-icon"></i><strong>{{ $subscription->start_date }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="alert alert-secondary alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                    <i class="ri-map-pin-time-fill label-icon"></i><strong>{{ $subscription->end_date }}</strong>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-label"><i class="ri-time-fill label-icon align-middle fs-16 me-2 "></i> {!! Helper::dateDiff (date('Y-m-d'),$subscription->end_date) !!}</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
<script src="{{ URL::asset('/assets/js/fs_fonts.jss') }}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@endsection
