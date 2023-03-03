@extends('layouts.master')
@section('title') @lang('translation.team') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Pages @endslot
@slot('title') Team @endslot
@endcomponent

<div class="card">
    <div class="card-body">
        <div class="row g-2">
                <div class="col-sm-4">
                <form method="GET"  action="{{ route('services_list') }}">
                    <div class="search-box">
                            @csrf
                            <input type="text" name="query" class="form-control"  placeholder="Search for name or designation...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->
                <div class="col-sm-2">
                <button type="submit" class="btn btn-success addMembers-modal" ><i class="ri-search-line"></i></button></form>
                </div>
                <div class="col-sm-auto ms-auto">
                    <div class="list-grid-nav hstack gap-1">
                        <button type="button" id="list-view-button" class="btn btn-soft-info nav-link  btn-icon fs-14 filter-button active"><i class="ri-list-unordered"></i></button>
                        <button type="button" id="grid-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 filter-button"><i class="ri-grid-fill"></i></button>
                        <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="ri-more-2-fill"></i></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                            <li><a class="dropdown-item" href="#">All</a></li>
                            <li><a class="dropdown-item" href="#">Last Week</a></li>
                            <li><a class="dropdown-item" href="#">Last Month</a></li>
                            <li><a class="dropdown-item" href="#">Last Year</a></li>
                        </ul>
                        <button class="btn btn-success addMembers-modal" data-bs-toggle="modal" data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Service</button>
                    </div>
                </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div>

            <div id="teamlist">
                <div class="team-list row list-view-filter" id="team-member-list">
                    @foreach ($services as $service)
                        <div class="col">
                            <div class="card team-box">
                                <div class="team-cover"><img src="../assets/images/small/img-3.jpg" alt="" class="img-fluid" /></div>
                                <div class="card-body p-4">
                                    <div class="row align-items-center team-row">
                                        <div class="col team-settings">
                                            <div class="row">
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-fill fs-17"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a service_gym_id="{{ Helper::getGymServiceByServiceId($service->id)->id }}" description="{{ $service->description}}" name="{{ $service->name}}" service_img="{{URL::asset('assets/images/services/'.Helper::getImageByEntityId($service->id, "services", "profile") )}}" service_gym="{{ Helper::getGymServiceByServiceId($service->id)->id }}" class="dropdown-item edit-list update_service" service_id="{{ $service->id }}" href="#updateSeviceModal" data-bs-toggle="modal" data-edit-id="4"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a>
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="4"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a>
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="team-profile-img">
                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0"><img id="service_img" src="{{URL::asset('assets/images/services/'.Helper::getImageByEntityId($service->id, "services", "profile") )}}" alt="" class="member-img img-fluid d-block rounded-circle" /></div>
                                                <div class="team-content">
                                                    <a class="member-name member-overview" description="{{ $service->description}}" name="{{ $service->name}}" data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview"> <h5 class="fs-16 mb-1">{{ $service->name}}</h5> </a>
                                                    <p class="text-muted member-designation mb-0">{{ Helper::getGymServiceByServiceId($service->id)->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="row text-muted text-center">
                                                <div class="col-6 border-end border-end-dashed">
                                                    <h5 class="mb-1 projects-num" id="member_count">{{ Helper::countAllMembersByService($service->id)  }}</h5>
                                                    <p class="text-muted mb-0">Members</p>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="mb-1 tasks-num" id="plan_count">{{ Helper::countAllPlansByService($service->id) }}</h5>
                                                    <p class="text-muted mb-0">Plans</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col">
                                            <div class="text-end"><a  data-bs-toggle="offcanvas" href="#member-overview" aria-controls="member-overview" class="btn btn-light view-btn member-overview">View</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                 <!-- Pagination -->

                <!-- End Pagination -->

                <!-- <div class="text-center mb-3">
                    <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load More </a>
                </div> -->
            </div>
            {{-- <div class="py-4 mt-4 text-center" id="noresult" style =  "@if($count > 0) display: none @endif" >
                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px"></lord-icon>
                <h5 class="mt-4">Sorry! No Result Found</h5>
            </div> --}}
            <!-- Modal -->
            <div class="modal fade" id="addmemberModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">

                        <div class="modal-body">
                            <form  method="POST" id="memberlist-form" class="needs-validation" action="{{ route('services_add') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" id="memberid-input" class="form-control" value="">
                                        <div class="px-1 pt-1">
                                            <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                                <img src="{{URL::asset('assets/images/small/img-9.jpg')}}" alt="" id="cover-img" class="img-fluid">

                                                <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                                    <div class="flex-grow-1">
                                                        <h5 class="modal-title text-white" id="createMemberLabel">@lang('translation.Add-New-Service')</h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="d-flex gap-3 align-items-center">
                                                            {{-- <div>
                                                                <label for="cover-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Cover Image">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                            <i class="ri-image-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                                <input class="form-control d-none" value="" id="cover-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                            </div> --}}
                                                            <button type="button" class="btn-close btn-close-white" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mb-4 mt-n5 pt-2">
                                            <div class="position-relative d-inline-block">
                                                <div class="position-absolute bottom-0 end-0">
                                                    <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                <i class="ri-image-fill"></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input class="form-control d-none" name="service_image" id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg"
                                                    onchange="document.getElementById('single-img').src = window.URL.createObjectURL(this.files[0])">
                                                </div>
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light rounded-circle">
                                                        <img src="{{URL::asset('assets/images/users/user-dummy-img.jpg')}}" id="single-img" class="avatar-md rounded-circle h-auto" />
                                                    </div>
                                                    @error('service_image')
                                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="serviceName" class="form-label">@lang('translation.name')</label>
                                            <input type="text" name="serviceName" class="form-control" id="serviceName" placeholder="@lang('translation.Enter-name')" required>
                                            @error('service_name')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gym" class="form-label">@lang('translation.gym')</label>
                                            <select name="gym" class="form-select" aria-label=".form-select-sm example" required>
                                                <option value="0">@lang('translation.chose')@lang('translation.gym')</option>
                                                @foreach ($gyms as $gym)
                                                    <option {{ old('gym') == $gym->id ? "selected" : "" }} value="{{ $gym->id }}">{{ $gym->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('gym')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>
                    
                                        

                                        <div class="mb-4">
                                            <label for="description" class="form-label">@lang('translation.description')</label>
                                            <input type="text" name="description" class="form-control" id="description" placeholder="@lang('translation.entrer the')@lang('translation.description')" required>
                                            @error('service_description')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.Close')</button>
                                            <button type="submit" class="btn btn-success" id="addNewMember">@lang('translation.save')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end modal-content-->
                </div>
                <!--end modal-dialog-->
            </div>
            <!--end modal-->

            <!-- Modal -->
            <div class="modal fade" id="updateSeviceModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">

                        <div class="modal-body">
                            <form  method="POST" id="service-update-form" class="needs-validation" action="{{ route('services_update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="service_id" id="service_id_hidden_input" class="form-control" value="">
                                        <input type="hidden" name="service_gym_id" id="service_gym_id_hidden_input" class="form-control" value="">
                                        <div class="px-1 pt-1">
                                            <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                                <img src="{{URL::asset('assets/images/small/img-9.jpg')}}" alt="" id="cover-img" class="img-fluid">

                                                <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                                    <div class="flex-grow-1">
                                                        <h5 class="modal-title text-white" id="createMemberLabel">@lang('translation.Update-Service')</h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="d-flex gap-3 align-items-center">
                                                            {{-- <div>
                                                                <label for="cover-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Cover Image">
                                                                    <div class="avatar-xs">
                                                                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                            <i class="ri-image-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                                <input class="form-control d-none" value="" id="cover-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                            </div> --}}
                                                            <button type="button" class="btn-close btn-close-white" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mb-4 mt-n5 pt-2">
                                            <div class="position-relative d-inline-block">
                                                <div class="position-absolute bottom-0 end-0">
                                                    <label for="member-image-input-update" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                <i class="ri-image-fill"></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <input class="form-control d-none" name="service_image_update" id="member-image-input-update" type="file" accept="image/png, image/gif, image/jpeg"
                                                    onchange="document.getElementById('single-img-update').src = window.URL.createObjectURL(this.files[0])">
                                                </div>
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light rounded-circle">
                                                        <img src="{{URL::asset('assets/images/users/user-dummy-img.jpg')}}" id="single-img-update" class="avatar-md rounded-circle h-auto service_img_update" />
                                                    </div>
                                                    @error('service_image')
                                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="serviceNameUpdate" class="form-label">@lang('translation.name')</label>
                                            <input type="text" name="serviceNameUpdate" class="form-control serviceNameUpdate" placeholder="@lang('translation.Enter-name')" required>
                                            @error('service_name')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gymUpdate" class="form-label">@lang('translation.gym')</label>
                                            <select name="gymUpdate" class="form-select serviceGymUpdate" aria-label=".form-select-sm example" required>
                                                <option value="0">@lang('translation.chose')@lang('translation.gym')</option>
                                                @foreach ($gyms as $gym)
                                                    <option {{ old('gym') == $gym->id ? "selected" : "" }} value="{{ $gym->id }}">{{ $gym->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('gym')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>
                    
                                        

                                        <div class="mb-4">
                                            <label for="descriptionUpdate" class="form-label">@lang('translation.description')</label>
                                            <input type="text" name="descriptionUpdate" class="form-control description_update" placeholder="@lang('translation.entrer the')@lang('translation.description')" required>
                                            @error('service_description')
                                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.Close')</button>
                                            <button type="submit" class="btn btn-success" id="addNewMember">@lang('translation.save')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end modal-content-->
                </div>
                <!--end modal-dialog-->
            </div>
            <!--end modal-->

            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="member-overview">
                <!--end offcanvas-header-->
                <div class="offcanvas-body profile-offcanvas p-0">
                    <div class="team-cover">
                        <img src="{{URL::asset('assets/images/small/img-9.jpg')}}" alt="" class="img-fluid" />
                    </div>
                    <div class="p-3">
                        <div class="team-settings">
                            <div class="row">
                                <div class="col text-end dropdown">
                                    <a href="javascript:void(0);" id="dropdownMenuLink14" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill fs-17"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink14">
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <div class="p-3 text-center">
                        <img id="view_service_img" src="" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto profile-img">
                        <div class="mt-3">
                            <h5 class="fs-15 profile-name"><span id="service_name"></span></h5>
                            <p class="text-muted profile-designation" id="view_description"></p>
                        </div>
                        <div class="hstack gap-2 justify-content-center mt-4">
              
                        </div>
                    </div>
                    <div class="row g-0 text-center">
                        <div class="col-6">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1 profile-project member_count"></h5>
                                <p class="text-muted mb-0">Members</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1 profile-task plan_count"></h5>
                                <p class="text-muted mb-0">Plans</p>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>
            <!--end offcanvas-->
        </div>
    </div><!-- end col -->
</div>
<!--end row-->

@endsection
@section('script')
<!-- <script src="{{ URL::asset('assets/js/pages/team.init.js') }}"></script> -->

<script>
    var list = document.querySelectorAll(".team-list");
    if (list) {
        var buttonGroups = document.querySelectorAll('.filter-button');
        if (buttonGroups) {
            Array.from(buttonGroups).forEach(function (btnGroup) {
                btnGroup.addEventListener('click', onButtonGroupClick);
            });
        }
    }

    function onButtonGroupClick(event) {
    if (event.target.id === 'list-view-button' || event.target.parentElement.id === 'list-view-button') {
        document.getElementById("list-view-button").classList.add("active");
        document.getElementById("grid-view-button").classList.remove("active");
        Array.from(list).forEach(function (el) {
            el.classList.add("list-view-filter");
            el.classList.remove("grid-view-filter");
        });

    } else {
        document.getElementById("grid-view-button").classList.add("active");
        document.getElementById("list-view-button").classList.remove("active");
        Array.from(list).forEach(function (el) {
            el.classList.remove("list-view-filter");
            el.classList.add("grid-view-filter");
        });
    }
}
</script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>
<script>
     $('.member-overview').click(function(){
        var service_name = $(this).attr("name");
        var service_description = $(this).attr("description");
        var service_img = $('#service_img').attr("src");
        var member_count = $('#member_count').text();
        var plan_count = $('#plan_count').text();

           $('#service_name').text(service_name);
           $('#view_description').text(service_description);
           $('#view_service_img').attr("src", service_img);
           $('.member_count').text(member_count);
           $('.plan_count').text(plan_count);
        });

        $('.update_service').click(function(){
            var service_id = $(this).attr("service_id");
            var service_gym_id = $(this).attr("service_gym_id");
            
            var service_name = $(this).attr("name");
            $('.serviceNameUpdate').attr("value", service_name);

            var service_description = $(this).attr("description");
            $('.description_update').attr("value", service_description);

            var service_gym = $(this).attr("service_gym");
            $(".serviceGymUpdate").val(service_gym).change();

            var service_img = $(this).attr("service_img");
            $('.service_img_update').attr("src", service_img);
            
            
            
            $('#service_id_hidden_input').attr("value", service_id);
            $('#service_gym_id_hidden_input').attr("value", service_gym_id);
            
        });
       
</script>
@endsection
