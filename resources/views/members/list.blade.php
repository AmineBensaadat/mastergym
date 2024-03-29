@extends('layouts.master')
@section('title') @lang('translation.members') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.pages') : @endslot
@slot('title') @lang('translation.members') @endslot
@endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />



<div class="row">
    @if ($error)
    <!-- Toast -->
    {{-- <div class="toast fade show center" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true" style="width: auto;">
        <div class="toast-header">
            <img src="{{ URL::asset('assets/images/logo_1.png')}}" class="rounded me-2" alt="..." height="20">
            <span class="fw-semibold me-auto">Members</span>
            <small>06 mins ago</small>
            <button type="button" class="btn-close"
                data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
           {{$error}}
        </div>
    </div> --}}

    @endif

    @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        @endif
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0 rounded">
                <div class="row g-2">
                    <div class="col-xl-3 col-sm-2">
                        <div class="search-box">
                            <input type="text" class="form-control search" placeholder="@lang('translation.Search-for-members') &amp; @lang('translation.name-or-something')"> <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-sm-2 ms-auto">
                    </div>
                    <!--end col-->
                    <div class="col-lg-auto col-sm-2">
                        <div class="hstack gap-2">
                            <a class="btn btn-info add-btn" data-bs-toggle="offcanvas" href="#costum-filter" aria-controls="costum-filter"> <i class="ri-filter-2-line me-1 align-bottom"></i> @lang('translation.filter') </a>
                            @can('member-import-button')
                                <a href="{{ route('members_import') }}" class="btn btn-soft-success">@lang('translation.Import')</a>
                            @endcan

                            @can('member-add-button')
                                <a href="{{ route('members_create') }}" class="btn btn-success"> <i class="ri-add-circle-line align-bottom"></i> @lang('translation.add') @lang('translation.member')</a>
                            @endcan
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
        </div>
        <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('translation.filter')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close" id="close-modal"></button>
                    </div>
                    <form action="#">
                        <div class="modal-body">
                            <input type="hidden" id="id-field" />
                            <div class="mb-3" id="modal-id" style="display: none;">
                                <label for="id-field1" class="form-label">ID</label>
                                <input type="text" id="id-field1" class="form-control"
                                    placeholder="ID" readonly />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!--end col-->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
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
                            <th >@lang('translation.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
            {{-- Custom Filtre Datatable --}}
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="costum-filter">
                <!--end offcanvas-header-->
                <div class="offcanvas-body profile-offcanvas p-0">
                    <!--end row-->
                    <div class="p-3 border-top">
                        <h5 class="fs-15 mb-4">Custom Filters</h5>
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">
                                Firstname</label>
                            <input type="text" id="filter_firstname"class="form-control filter_input" placeholder="Enter Firstname"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">
                                Lastname</label>
                            <input type="text" id="filter_lastname"class="form-control filter_input" placeholder="Enter Lastname" />
                        </div>
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">
                                cin</label>
                            <input type="text" id="filter_cin"class="form-control filter_input" placeholder="Enter cin" />
                        </div>
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">
                                phone</label>
                            <input type="text" id="filter_phone"class="form-control filter_input" placeholder="Enter phone"/>
                        </div>
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">
                                address</label>
                            <input type="text" id="filter_address"class="form-control filter_input" placeholder="Enter address"/>
                        </div>
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">
                                city</label>
                            <input type="text" id="filter_city"class="form-control filter_input" placeholder="Enter city"/>
                        </div>
                        <div class="mb-3">
                            <label for="gym" class="form-label">@lang('translation.gym')</label>
                            <select id="filter_gym" class="form-select" aria-label=".form-select-sm example">
                                <option value="">@lang('translation.chose')@lang('translation.gym')</option>
                                @foreach ($gyms as $gym)
                                    <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($services)
                        <div class="mb-3">
                            <label for="service" class="form-label">@lang('translation.service')</label>
                            <select id="filter_service" class="form-select" aria-label=".form-select-sm example">
                                <option value="">@lang('translation.chose')@lang('translation.service')</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label" for="service-input">@lang('translation.plans')</label>
                            <select id="filter_plans" class="form-select" aria-label=".form-select-sm example" required>
                                <option value="">@lang('translation.chose')@lang('translation.plans')</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end offcanvas-body-->
                <div class="offcanvas-foorter border p-3 hstack gap-3 text-center position-relative">
                    <button  id="reset_fiter" class="btn btn-light w-100"><i class="ri-close-line align-bottom ms-1"></i>Clear All</button>
                    <button  id="filter-btn" class="btn btn-primary w-100"><i class="ri-search-line search-icon align-bottom ms-1"></i> Search</button>
                </div>
            </div>
            <!--end Filtre -->
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

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
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

        $('#members_dt tbody').on('click', '.delete_member', function() {
            var member_id = $(this).attr('member_id');

            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Yes, delete it!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url :"/members/delete",
                    type:"POST",
                    cache:false,
                    data:{
                        member_id:member_id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){
                        if(data.statu){
                            Swal.fire({
                            title: 'Deleted!',
                            text: 'Your member has been deleted.',
                            icon: 'success',
                            confirmButtonClass: 'btn btn-primary w-xs mt-2',
                            buttonsStyling: false
                            })

                            $('#members_dt').DataTable().destroy();
                            fill_datatable();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data,
                            })
                        }

                }
            });

            }
        });
        });
    });

</script>
@endsection
