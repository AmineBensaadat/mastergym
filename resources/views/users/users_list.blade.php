@extends('layouts.master')
@section('title') @lang('translation.team') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Team @endslot
@endcomponent

<div class="row g-4 mb-4">
    <div class="col-sm-auto">
        <div>
            <a href="{{ route('users_create') }}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add user</a>
        </div>
    </div>
    <div class="col-sm">
        <div class="d-md-flex justify-content-sm-end gap-2">
            <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                <input type="text" class="form-control" id="searchJob" autocomplete="off" placeholder="Search for candidate name or designation..." />
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row gy-2 mb-2" id="candidate-list">
    <div class="col-md-6 col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="d-lg-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avatar-sm rounded"><img src="assets/images/users/avatar-10.jpg" alt="" class="member-img img-fluid d-block rounded" /></div>
                    </div>
                    <div class="ms-lg-3 my-3 my-lg-0">
                        <a href="pages-profile.html"><h5 class="fs-16 mb-2">Tonya Noble</h5></a>
                        <p class="text-muted mb-0">Web Designer</p>
                    </div>
                    <div class="d-flex gap-4 mt-0 text-muted mx-auto">
                        <div><i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i> Cullera, Spain</div>
                        <div><i class="ri-time-line text-primary me-1 align-bottom"></i> <span class="badge badge-soft-danger">Part Time</span></div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 align-items-center mx-auto my-3 my-lg-0">
                        <div class="badge text-bg-success"><i class="mdi mdi-star me-1"></i>4.2</div>
                        <div class="text-muted">2.2k Ratings</div>
                    </div>
                    <div>
                        <a href="#!" class="btn btn-soft-success">View Details</a>
                        <a href="#!" class="btn btn-ghost-danger btn-icon custom-toggle active" data-bs-toggle="button">
                            <span class="icon-on"><i class="ri-bookmark-line align-bottom"></i></span> <span class="icon-off"><i class="ri-bookmark-3-fill align-bottom"></i></span>
                        </a>
                    </div>
                </div>
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
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@if (session('stored'))
    <script src="{{ URL::asset('/assets/js/custom/coustom_toastify.js') }}"></script>
    {{ session(['stored' => false]) }}
@endif

@endsection

