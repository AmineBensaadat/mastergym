@extends('layouts.master')
@section('title') @lang('translation.members') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') @lang('translation.members') @endslot
@endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0 rounded">
                <div class="row g-2">
                    <div class="col-xl-3">
                        <div class="search-box">
                            <input type="text" class="form-control search" placeholder="Search for members &amp; owner name or something..."> <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 ms-auto">
                    </div>
                    <!--end col-->
                    <div class="col-lg-auto">
                        <div class="hstack gap-2">
                            <a class="btn btn-info add-btn" data-bs-toggle="offcanvas" href="#costum-filter" aria-controls="costum-filter"> <i class="ri-filter-2-line me-1 align-bottom"></i> @lang('translation.filter') </a>
                            <a href="{{ route('members_create') }}" class="btn btn-success"> <i class="ri-add-circle-line align-bottom"></i> @lang('translation.add') @lang('translation.member')</a>
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

                            {{-- <div class="mb-3">
                                <label for="customername-field" class="form-label">
                                    Firstname</label>
                                <input type="text" id="filter_firstname"
                                    class="form-control" placeholder="Enter name"
                                    required />
                            </div> --}}


                        </div>
                        {{-- <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success"
                                    id="filter-btn">Filter</button>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!--end col-->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {{-- <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th >@lang('translation.member')</th>
                            <th >@lang('translation.phone')</th>
                            <th >@lang('translation.email')</th>
                            <th >@lang('translation.address')</th>
                            <th >@lang('translation.cin')</th>
                            <th >@lang('translation.status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                     @if ($member->img_name)
                                        @if(file_exists('assets/images/members/'.$member->img_name))
                                        <img class="image avatar-xs rounded-circle" alt="" src="{{URL::asset('assets/images/members/'.$member->img_name )}}">
                                        @else
                                        <img class="image avatar-xs rounded-circle" alt="" src="{{URL::asset('assets/images/members/default.jpg' )}}">
                                        @endif
                                    @else
                                    <img class="image avatar-xs rounded-circle" alt="" src="{{URL::asset('assets/images/members/default.jpg' )}}">
                                    @endif
                                    </div>
                                    <div class="flex-grow-1 ms-2 name">

                                        <a href="../members/show/{{ $member->id }}">
                                            {{ $member->lastname." ".$member->firstname }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->address }}</td>
                            <td>{{ $member->cin }}</td>
                            <td>
                                @if ($member->status == 1)
                                    <span class="badge bg-success">active</span>
                                @else
                                    <span class="badge bg-danger">inactive</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}

                <table id="members_dt" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th >@lang('translation.member')</th>
                            <th >@lang('translation.gym')</th>
                            <th >@lang('translation.Service')</th>
                            <th >@lang('translation.address')</th>
                            <th >@lang('translation.CNIE')</th>
                            <th >@lang('translation.Status')</th>
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
                            <input type="text" id="filter_firstname"class="form-control filter_input" placeholder="Enter name"
                                required />
                        </div>
                    </div>
                </div>
                <!--end offcanvas-body-->
                <div class="offcanvas-foorter border p-3 hstack gap-3 text-center position-relative">
                    <button  id="reset_fiter" class="btn btn-light w-100"><i class="ri-close-line align-bottom ms-1"></i> Reset filter</button>
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
<script src="{{ URL::asset('/assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/fs_fonts.jss') }}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script>

    $(document).ready(function(){
        fill_datatable();
        function fill_datatable(global_filter = '' ,filter_firstname = '' )
            {
                var dataTable = $('#members_dt').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order" : [],
                    "searching" : false,
                    "ajax" : {
                    url:"../members/getAllMembers",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        global_filter:global_filter,
                        filter_firstname:filter_firstname
                    }
                    }
                });
            }

            $( ".search" ).keyup(function() {
                $('#members_dt').DataTable().destroy();
                var global_filter = $('.search').val();
                fill_datatable(global_filter);
            });

        $('#filter-btn').click(function(){
            var filter_firstname = $('#filter_firstname').val();
            if(filter_firstname != '')
            {
                $('#members_dt').DataTable().destroy();
                fill_datatable(global_filter ,filter_firstname);
                $('#costum-filter').offcanvas('hide');
            }
            // else
            // {
            //     alert('Select Both filter option');
            //     $('#members_dt').DataTable().destroy();
            //     fill_datatable();
            // }
        });

        $('#reset_fiter').click(function(){
            $('#costum-filter').offcanvas('hide');
            $('.filter_input').val('');
            $('#members_dt').DataTable().destroy();
            fill_datatable();
        });
    });
</script>
@endsection
