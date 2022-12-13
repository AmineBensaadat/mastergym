@extends('layouts.master')
@section('title') @lang('translation.gyms') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.gyms') @endslot
@slot('title')@lang('translation.gyms') @endslot
@endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="d-lg-flex align-items-center mb-4">
                <div class="flex-grow-1">
                    <h5 class="card-title mb-0 fw-bold fs-17">All Gyms</h5>
                </div>
                <div class="flex-shrink-0 mt-4 mt-lg-0">
                    <a href="gym/create" class="btn btn-soft-primary"> <i class="ri-add-circle-line align-bottom"></i> Add Gym </a>
                </div>
            </div>
        </div>
    </div>
    @if (!$gyms->isEmpty())
        <div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">
            @foreach ($gyms as $gym)
                <div class="col">
                    <div class="card explore-box card-animate">
                        <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                            <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                        </div>
                        <div class="explore-place-bid-img">
                            <img src="{{URL::asset('assets/images/gyms/'.$gym->gym_img.'.'.$gym->ext )}}" alt="" class="card-img-top explore-img" />
                            <div class="bg-overlay"></div>
                            <div class="place-bid-btn">
                                <a href="../gym/show" class="btn btn-success"><i class="ri-eye-line align-bottom me-1"></i> View</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-1"><a href="apps-nft-item-details">{{ $gym->gym_name }}</a></h5>
                            <p class="text-muted mb-0">Main</p>
                        </div>
                        <div class="card-footer border-top border-top-dashed">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 fs-14">
                                    <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Tottale Membres: 
                                </div>
                                <h5 class="flex-shrink-0 fs-14 text-primary mb-0">3500</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
            <div class="col-lg-12">
                <div class="card overflow-hidden shadow-none">
                    <div class="card-body bg-soft-success text-success fw-semibold d-flex">
                        <marquee class="fs-14">
                            No Gym yet
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
