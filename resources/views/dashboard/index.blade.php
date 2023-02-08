@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.dashboards') @endslot
        @slot('title') @lang('translation.dashboards') @endslot
    @endcomponent

<!--datatable css-->
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
@endsection
            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                        <i class="ri-team-fill text-primary"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    @lang('translation.Total-Members')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $allMembers }}">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">@lang('translation.Total-Members-active')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                        <i class="ri-user-add-fill text-success"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">@lang('translation.Monthly-Joinings')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $monthlyJoined }}">0</span></h4>
                                        <span class="badge badge-soft-success fs-12"><i
                                                class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58
                                            %</span>
                                    </div>
                                    <p class="text-muted mb-0">@lang('translation.Members-joines-per-month')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
                                        <i class="ri-coin-line text-info"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    @lang('translation.Pending-Payments')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="{{ $pending_paiment }}">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">@lang('translation.Member-Pending-Payments')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-3">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-danger text-danger rounded-2 fs-2">
                                        <i data-feather="clock" class="text-danger"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                    @lang('translation.Expired')</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                            data-target="{{ $expired_members }}">0</span></h4>
                                        <span class="badge badge-soft-danger fs-12"><i
                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                            %</span>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">@lang('translation.Subscription-Expire')</p>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

    <div class="row">
        <!-- start col -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">@lang('translation.Monthly-Joinings')</h4>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">@lang('translation.Export')</a>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
                    {{-- <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                    href="#home1" role="tab" aria-selected="true">
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> All Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered"
                                    href="#delivered" role="tab" aria-selected="false">
                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Delivered
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups"
                                    href="#pickups" role="tab" aria-selected="false">
                                    <i class="ri-truck-line me-1 align-bottom"></i> Pickups <span
                                        class="badge bg-danger align-middle ms-1">2</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns"
                                    href="#returns" role="tab" aria-selected="false">
                                    <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Returns
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled"
                                    href="#cancelled" role="tab" aria-selected="false">
                                    <i class="ri-close-circle-line me-1 align-bottom"></i> Cancelled
                                </a>
                            </li>
                        </ul>
    
                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th scope="col" style="width: 25px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">Order ID</th>
                                        <th class="sort" data-sort="customer_name">Customer</th>
                                        <th class="sort" data-sort="product_name">Product</th>
                                        <th class="sort" data-sort="date">Order Date</th>
                                        <th class="sort" data-sort="amount">Amount</th>
                                        <th class="sort" data-sort="payment">Payment Method</th>
                                        <th class="sort" data-sort="status">Delivery Status</th>
                                        <th class="sort" data-sort="city">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="checkAll" value="option1">
                                            </div>
                                        </th>
                                        <td class="id"><a href="apps-ecommerce-order-details"
                                                class="fw-medium link-primary">#VZ2101</a></td>
                                        <td class="customer_name">Frank Hook</td>
                                        <td class="product_name">Puma Tshirt</td>
                                        <td class="date">20 Dec, 2021, <small class="text-muted">02:21
                                                AM</small></td>
                                        <td class="amount">$654</td>
                                        <td class="payment">Mastercard</td>
                                        <td class="status"><span
                                                class="badge badge-soft-warning text-uppercase">Pending</span>
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                    title="View">
                                                    <a href="apps-ecommerce-order-details"
                                                        class="text-primary d-inline-block">
                                                        <i class="ri-eye-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item edit"
                                                    data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                    data-bs-placement="top" title="Edit">
                                                    <a href="#showModal" data-bs-toggle="modal"
                                                        class="text-primary d-inline-block edit-item-btn">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                    title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="#deleteOrder">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop" colors="primary:#405189,secondary:#0ab39c"
                                        style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted">We've searched more than 150+ Orders We did
                                        not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="table-responsive table-card">
                        {{-- <table class="table table-nowrap table-centered align-middle table-success">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th scope="col">@lang('translation.name')</th>
                                    <th scope="col">@lang('translation.Service')</th>
                                    <th scope="col">@lang('translation.plans')</th>
                                    <th scope="col">@lang('translation.Joined-at')</th>
                                    <th scope="col">@lang('translation.day-left')</th>
                                </tr><!-- end tr -->
                            </thead><!-- thead -->

                            <tbody>
                                <tr>
                                    <td class="fw-medium">Brand Logo Design</td>
                                    <td>
                                        <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}"
                                            class="avatar-xxs rounded-circle me-1" alt="">
                                        <a href="javascript: void(0);" class="text-reset">Donald
                                            Risher</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-1 text-muted fs-13">53%</div>
                                            <div class="progress progress-sm  flex-grow-1"
                                                style="width: 68%;">
                                                <div class="progress-bar bg-primary rounded"
                                                    role="progressbar" style="width: 53%"
                                                    aria-valuenow="53" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group flex-nowrap">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block">
                                                    <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt=""
                                                        class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-soft-warning">Inprogress</span></td>
                                </tr>
                                <!-- end tr -->
                            </tbody><!-- end tbody -->
                        </table><!-- end table --> --}}
                        <table id="members_dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th >@lang('translation.member')</th>
                                    <th >@lang('translation.gym')</th>
                                    <th >@lang('translation.services')</th>
                                    <th >@lang('translation.plans')</th>
                                    <th >@lang('translation.Joined-at')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Statistiques</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="store-visits-source"
                        data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                        class="apex-charts" dir="ltr"></div>
                </div>
            </div> <!-- .card-->
        </div> 
        <!-- end col -->


    </div><!-- end row -->

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/fs_fonts.jss') }}"></script>
    
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
    

    {{-- <script src="{{ URL::asset('/assets/js/pages/dashboard-projects.init.js') }}"></script> --}}
    <script src="{{ URL::asset('/assets/js/app.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script>

        $(document).ready(function(){
            fill_datatable();
            function fill_datatable(global_filter = '' ,filter_firstname = '', filter_lastname = '', gymId = '', filter_cin = '', filter_phone = '', filter_address = '', filter_city= '', filter_service ='', filter_plans = '' )
                {
                    var dataTable = $('#members_dt').DataTable({
                        "processing" : true,
                        "serverSide" : true,
                        "order" : [],
                        "scrollX": true,
                        "searching" : false,
                        "ajax" : {
                        url:"../members/getMonthlyJoiningsMembers",
                        type:"POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            global_filter:global_filter,
                            filter_firstname:filter_firstname,
                            filter_lastname:filter_lastname,
                            filter_cin:filter_cin,
                            filter_phone:filter_phone,
                            filter_address:filter_address,
                            filter_city:filter_city,
                            filter_service:filter_service,
                            filter_plans:filter_plans,
                            gymId:gymId
                        }
                        }
                    });
                }
    
                $( ".search" ).keyup(function() {
                    var global_filter = $('.search').val();
                    $('#members_dt').DataTable().destroy();
                    fill_datatable(global_filter);
                });
    
            $('#filter-btn').click(function(){
                var filter_firstname = $('#filter_firstname').val();
                var filter_lastname = $('#filter_lastname').val();
                var filter_cin = $('#filter_cin').val();
                var filter_phone = $('#filter_phone').val();
                var filter_address = $('#filter_address').val();
                var filter_city = $('#filter_city').val();
                var gymId = $( "#filter_gym option:selected" ).val();
                var filter_service = $( "#filter_service option:selected" ).val();
                var filter_plans = $( "#filter_plans option:selected" ).val();
    
                    $('#members_dt').DataTable().destroy();
                    fill_datatable($('.search').val(),filter_firstname, filter_lastname, gymId, filter_cin, filter_phone, filter_address, filter_city, filter_service, filter_plans);
                    $('#costum-filter').offcanvas('hide');
            });
            $('#reset_fiter').click(function(){
                $('#costum-filter').offcanvas('hide');
                $('.filter_input').val('');
                $('#members_dt').DataTable().destroy();
                fill_datatable();
            });
            var html = '';
    
    
        $("#filter_service").on("change",function(){
            html = '';
            var serviceId = $(this).val();
            $.ajax({
                url :"/plans/allPlansByService",
                type:"POST",
                cache:false,
                data:{serviceId:serviceId, _token: '{{csrf_token()}}'},
                success:function(data){
                    if((data.plans).length > 0){
                        $.each(data.plans, function (key, val) {
                            html += '<option value="'+val.id+'">'+val.plan_name+'</option>';
                            $("#filter_plans").html(html);
                        });
                    }else{
                        html = '<option value="">Select plans</option>';
                        $("#filter_plans").html(html);
    
    
                    }
                }
            });
        });
        });
    </script>

@endsection
