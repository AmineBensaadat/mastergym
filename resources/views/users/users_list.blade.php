@extends('layouts.master')
@section('title') @lang('translation.team') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Team @endslot
@endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />


<div class="row g-4 mb-4">
    <div class="col-sm-auto">
        <div>
            <a href="{{ route('users_create') }}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add user</a>
        </div>
    </div>
    <div class="col-sm">
        <div class="d-md-flex justify-content-sm-end gap-2">
            <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                <input type="text" class="form-control search" id="searchJob" autocomplete="off" placeholder="Search for candidate name or designation..." />
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row gy-2 mb-2" id="candidate-list">
    <div class="col-md-6 col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <table id="users_dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
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
        </div>
    </div>
</div>
<!-- end row -->

<!-- pagination -->
<div class="row g-0 justify-content-end mb-4" id="pagination-element">
    <!-- end col -->
    <div class="col-sm-6">
        <div class="pagination-block pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
            <div class="page-item disabled">
                <a href="javascript:void(0);" class="page-link" id="page-prev">Previous</a>
            </div>
            <span id="page-num" class="pagination">
                <div class="page-item active"><a class="page-link clickPageNumber" href="javascript:void(0);">1</a></div>
                <div class="page-item"><a class="page-link clickPageNumber" href="javascript:void(0);">2</a></div>
                <div class="page-item"><a class="page-link clickPageNumber" href="javascript:void(0);">3</a></div>
            </span>
            <div class="page-item">
                <a href="javascript:void(0);" class="page-link" id="page-next">Next</a>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end pagination -->

@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>

<script src="{{ URL::asset('/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/buttons.html5.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

<script>

    $(document).ready(function(){
        fill_datatable();
        function fill_datatable(global_filter = '' ,filter_firstname = '', filter_lastname = '', gymId = '', filter_cin = '', filter_phone = '', filter_address = '', filter_city= '', filter_service ='', filter_plans = '' )
            {
                var dataTable = $('#users_dt').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order" : [],
                    "scrollX": true,
                    "searching" : false,
                    "ajax" : {
                    url:"../users/getAllUsers",
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
                $('#users_dt').DataTable().destroy();
                fill_datatable(global_filter);
            });

  



    });
</script>

@if (session('stored'))
    <script src="{{ URL::asset('/assets/js/custom/coustom_toastify.js') }}"></script>
    {{ session(['stored' => false]) }}
@endif

@endsection

