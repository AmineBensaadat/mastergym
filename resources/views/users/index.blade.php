@extends('layouts.master')
@section('title') @lang('translation.users') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.pages') : @endslot
@slot('title') @lang('translation.users') @endslot
@endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />


<div class="row g-4 mb-4">
        <div class="col-sm-auto">
            <div>
                <a href="{{ route('users_create') }}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> @lang('translation.add') @lang('translation.user')</a>
            </div>
        </div>
    <div class="col-sm">
        <div class="d-md-flex justify-content-sm-end gap-2">
            <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                <input type="text" class="form-control search" id="searchJob" autocomplete="off" placeholder="@lang('translation.Search-for') @lang('translation.name-or-something') " />
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
                            <th >@lang('translation.user')</th>
                            <th >@lang('translation.email')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->


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
        function fill_datatable(global_filter = '' ,filter_name = '', filter_email = '')
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
                        filter_name:filter_name,
                        filter_email:filter_email
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

