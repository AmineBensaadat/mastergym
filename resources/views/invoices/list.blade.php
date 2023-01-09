@extends('layouts.master')
@section('title') @lang('translation.team') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Members @endslot
@endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/custom_invoices.css') }}" rel="stylesheet" type="text/css" />



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <div class="flex-grow-1">
                        <a href="{{ route('members_create') }}" class="btn btn-success"> <i class="ri-add-circle-line align-bottom"></i> Add Member </a>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="hstack text-nowrap gap-2">
                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                            <button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#addmembers"><i
                                    class="ri-filter-2-line me-1 align-bottom"></i> Filters</button>
                            <button class="btn btn-soft-success">Import</button>
                            <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                aria-expanded="false" class="btn btn-soft-info"><i
                                    class="ri-more-2-fill"></i></button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <li><a class="dropdown-item" href="#">All</a></li>
                                <li><a class="dropdown-item" href="#">Last Week</a></li>
                                <li><a class="dropdown-item" href="#">Last Month</a></li>
                                <li><a class="dropdown-item" href="#">Last Year</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!--end col-->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th >@lang('translation.N°')</th>
                            <th >@lang('translation.created_at')</th>
                            <th >@lang('translation.received')</th>
                            <th >@lang('translation.subscription_price')</th>
                            <th >@lang('translation.discount')</th>
                            <th >@lang('translation.discount_amount')</th>
                            <th >@lang('translation.rest')</th>
                            <th >@lang('translation.payment_mode')</th>
                            <th >@lang('translation.additional_fees')</th>
                            <th >@lang('translation.member')</th>
                            <th >@lang('translation.service')</th>
                            <th >@lang('translation.plan')</th>
                            <th >@lang('translation.comment')</th>
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
                            <td>
                                <div class="d-flex align-items-center">            
                                    <div class="flex-shrink-0">
                                    @if ($invoice->member_img)
                                        @if(file_exists('assets/images/members/'.$invoice->member_img)) 
                                        <img class="image avatar-xs rounded-circle" alt="" src="{{URL::asset('assets/images/members/'.$invoice->member_img )}}">
                                        @else
                                        <img class="image avatar-xs rounded-circle" alt="" src="{{URL::asset('assets/images/members/default.jpg' )}}">
                                        @endif
                                    @else
                                    <img class="image avatar-xs rounded-circle" alt="" src="{{URL::asset('assets/images/members/default.jpg' )}}">
                                    @endif 
                                    </div>            
                                    <div class="flex-grow-1 ms-2 name">

                                        <a href="../members/show/{{ $invoice->member_id }}">
                                            {{ $invoice->lastname." ".$invoice->firstname }}
                                        
                                        </a>    
                                    </div>            
                                </div>
                            </td>
                            <td><div class="d-flex align-items-center">
                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                    <img class="img-fluid d-block" alt="" src="{{URL::asset('assets/images/services/'.Helper::getImageByEntityId($invoice->service_id, "services") )}}">
                                </div>
                                <div>
                                    <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $invoice->service_name }}</a></h5>
                                </div>
                            </div></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                            <img class="img-fluid d-block" alt="" src="{{URL::asset('assets/images/plans/'.Helper::getImageByEntityId($invoice->plan_id, "plans") )}}">
                                    </div>
                                    <div>
                                        <h5 class="fs-14 my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">{{ $invoice->plan_name }}</a></h5>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $invoice->payment_comment }}</td>
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
<script src="{{ URL::asset('/assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/fs_fonts.jss') }}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@endsection
