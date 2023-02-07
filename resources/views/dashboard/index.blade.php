@extends('layouts.master')
@section('title') @lang('translation.dashboards') @endsection
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.dashboards') @endslot
        @slot('title') @lang('translation.dashboards') @endslot
    @endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
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
                                                data-target="{{ $members }}">0</span></h4>
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
                                                data-target="7522">0</span></h4>
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
                                            data-target="777">0</span></h4>
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
                                            data-target="777">0</span></h4>
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
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">@lang('translation.Monthly-Joinings')</h4>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">@lang('translation.Export')</a>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
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
                                    <th >@lang('translation.phone')</th>
                                    <th >@lang('translation.CNIE')</th>
                                    <th >@lang('translation.city')</th>
                                    <th >@lang('translation.address')</th>
                                    <th >@lang('translation.DOB')</th>
                                    <th >@lang('translation.Status')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <!-- start col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title flex-grow-1 mb-0">@lang('translation.Expired') @lang('translation.members')</h4>
                    <div class="flex-shrink-0">
                        <a href="javascript:void(0);" class="btn btn-soft-info btn-sm">@lang('translation.Export')</a>
                    </div>
                </div><!-- end cardheader -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-centered align-middle table-danger">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th scope="col">@lang('translation.name')</th>
                                    <th scope="col">@lang('translation.Service')</th>
                                    <th scope="col">@lang('translation.plans')</th>
                                    <th scope="col">@lang('translation.expired-at')</th>
                                    <th scope="col">@lang('translation.expired-days')</th>
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

                                    <td><span class="badge badge-soft-warning">Inprogress</span></td>
                                    <td class="text-muted">06 Sep 2021</td>
                                </tr>
                                <!-- end tr -->
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>

                    <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                        <div class="flex-shrink-0">
                            <div class="text-muted">@lang('translation.Showing') <span class="fw-semibold">5</span> @lang('translation.of') <span
                                    class="fw-semibold">25</span> @lang('translation.Results')
                            </div>
                        </div>
                        <ul class="pagination pagination-separated pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">←</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">→</a>
                            </li>
                        </ul>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
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
                        url:"../members/getAllMembers",
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
