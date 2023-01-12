@extends('layouts.master')
@section('title') @lang('translation.members') @endsection
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



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0 rounded">
                <div class="row g-2">
                    <div class="col-xl-3">
                        <div class="search-box">
                            <input type="text" class="form-control search" placeholder="Search for sellers &amp; owner name or something..."> <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 ms-auto">
                        {{-- <div>
                            <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-choices="" data-choices-search-false="" hidden="" tabindex="-1" data-choice="active"><option value="Computers &amp; Electronics" data-custom-properties="[object Object]">Computers &amp;amp; Electronics</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="4" data-value="Computers &amp; Electronics" data-custom-properties="[object Object]" aria-selected="true">Computers &amp; Electronics</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--5h0q-item-choice-7" class="choices__item choices__item--choice choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="7" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Select Categories</div><div id="choices--5h0q-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="All" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">All</div><div id="choices--5h0q-item-choice-2" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Computers &amp; Electronics" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">Computers &amp; Electronics</div><div id="choices--5h0q-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Food Service" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">Food Service</div><div id="choices--5h0q-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Health &amp; Medicine" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">Health &amp; Medicine</div><div id="choices--5h0q-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="Manufacturer" data-select-text="Press to select" data-choice-selectable="" aria-selected="false">Manufacturer</div><div id="choices--5h0q-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Retailer" data-select-text="Press to select" data-choice-selectable="">Retailer</div></div></div></div>
                        </div> --}}
                    </div>
                    <!--end col-->
                    <div class="col-lg-auto">
                        <div class="hstack gap-2">
                            <button type="button" class="btn btn-danger"><i class="ri-equalizer-fill me-1 align-bottom"></i> Filters</button>
                            <a href="{{ route('members_create') }}" class="btn btn-success"> <i class="ri-add-circle-line align-bottom"></i> Add Member </a>
                            <button type="button" class="btn btn-success add-btn"
                                    data-bs-toggle="modal" id="create-btn"
                                    data-bs-target="#showModal"><i
                                        class="ri-add-line align-bottom me-1"></i> Add Customer</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
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
    
                            <div class="mb-3">
                                <label for="customername-field" class="form-label">
                                    Firstname</label>
                                <input type="text" id="filter_firstname"
                                    class="form-control" placeholder="Enter name"
                                    required />
                            </div>
    
                         
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success"
                                    id="filter-btn">Filter</button>
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
                            <th >@lang('translation.phone')</th>
                            <th >@lang('translation.email')</th>
                            <th >@lang('translation.address')</th>
                            <th >@lang('translation.cin')</th>
                            <th >@lang('translation.status')</th>
                        </tr>
                    </thead>
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
<script>

    $(document).ready(function(){
        fill_datatable();
        function fill_datatable(filter_firstname = '')
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
                        filter_firstname:filter_firstname
                    }
                    }
                });
            }

        $('#filter-btn').click(function(){
            var filter_firstname = $('#filter_firstname').val();
            if(filter_firstname != '')
            {
                $('#members_dt').DataTable().destroy();
                fill_datatable(filter_firstname);
            }
            else
            {
                alert('Select Both filter option');
                $('#members_dt').DataTable().destroy();
                fill_datatable();
            }
        });
    });
</script>
@endsection
