@extends('layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{URL::asset(Helper::getImageByEntityId(Auth::user()->id, "users", "profile") )}}"
                                class="  rounded-circle avatar-xl img-thumbnail user-profile-image"
                                alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">{{Auth::user()->name}}</h5>
                        {{-- <p class="text-muted mb-0">Lead Designer / Developer</p> --}}
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Portfolio </h5>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i
                                    class="ri-add-fill align-bottom me-1"></i> Add</a>
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                <i class="ri-github-fill"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control" id="gitUsername" placeholder="Username"
                            value="@daveadame">
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                <i class="ri-global-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="websiteInput" placeholder="www.example.com"
                            value="www.velzon.com">
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                <i class="ri-dribbble-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="dribbleName" placeholder="Username"
                            value="@dave_adame">
                    </div>
                    <div class="d-flex">
                        <div class="avatar-xs d-block flex-shrink-0 me-3">
                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                <i class="ri-pinterest-fill"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="pinterestName" placeholder="Username"
                            value="Advance Dave">
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-md-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#lang" role="tab" aria-selected="true">
                                <i class="far fa-envelope"></i>
                                Langue
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="lang" role="tabpanel">
                            <form id="createMember-form" method="POST" class="needs-validation"  action="{{ route('storeLang') }}" >
                                @csrf
                                <div id="newlink">
                                    <div id="1">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="jobTitle" class="form-label">Langue</label>
                                                    <div data-input-flag data-option-flag-img-name>
                                                        <input type="text" name="lang" class="form-control rounded-end flag-input" style="background-repeat: no-repeat; background-image: url(../assets/images/flags/{{ $curtentUser->lang ? $curtentUser->lang : 'fr' }}.svg);" readonly value="{{ __('translation.'.($curtentUser->lang ? $curtentUser->lang : 'fr')) }}" placeholder="Select country" data-bs-toggle="dropdown" aria-expanded="false" />
                                                        <div class="dropdown-menu w-100">
                                                            <div class="p-2 px-3 pt-1 searchlist-input">
                                                                <input type="text" class="form-control form-control-sm border search-countryList" placeholder="Search country name or country code..." />
                                                            </div>
                                                            <ul class="list-unstyled dropdown-menu-list mb-0">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                                <div id="newForm" style="display: none;">

                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('updatePassword') }}" method="POST" id="change_password_form">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">OldPassword*</label>
                                            <input type="password" name="current_password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                        </div>
                                        <span class="invalid-feedback oldpasswordInput" role="alert">
                                            <strong></strong>
                                        </span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                            <input type="password" name="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                        </div>
                                        <span class="invalid-feedback password" role="alert">
                                            <strong></strong>
                                        </span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                            <input type="password" name="confirm_password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                        </div>
                                        <span class="invalid-feedback confirm_password" role="alert">
                                            <strong></strong>
                                        </span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="Lang" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Custom country select input</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="mt-3">
                                                        <label class="form-label">Select input flag with img & name</label>
                                                        <form id="createMember-form" method="POST" class="needs-validation"  action="{{ route('storeLang') }}" novalidate enctype="multipart/form-data">
                                                            @csrf
                                                    </div>
                                                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <!-- input flag init -->
    <script src="{{URL::asset('assets/js/pages/flag-input.init.js')}}"></script>
    <script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#change_password_form").submit(function (event) {
                event.preventDefault();
                var member_id = $(this).attr('member_id');

                Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Yes, change it!",
                buttonsStyling: false,
                showCloseButton: true
                }).then(function (result) {
                      $.ajax({
                            url: "/users/update-password",
                            type:"POST",
                            cache:false,
                            data:{
                                current_password:$("#oldpasswordInput").val(), 
                                password:$("#newpasswordInput").val(),
                                password_confirmation:$("#confirmpasswordInput").val(),
                                _token: '{{csrf_token()}}'
                                 },
                                success:function(data){
                                    if(data.isSuccess){
                                            Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: data.Message,
                                            showConfirmButton: false,
                                            timer: 1500,
                                            showCloseButton: false
                                        });

                                        $("#oldpasswordInput").val(""), 
                                        $("#newpasswordInput").val(""),
                                        $("#confirmpasswordInput").val("")
                                    }else{
                                        
                                        Swal.fire({
                                        title: 'Error',
                                        text: data.Message,
                                        imageUrl: 'assets/images/logo-light.png',
                                        imageHeight: 40,
                                        confirmButtonClass: 'btn btn-primary w-xs mt-2',
                                        buttonsStyling: false,
                                        animation: false,
                                        showCloseButton: true
                                    });
                                        $(".oldpasswordInput").css("display", "block"); 
                                        $(".oldpasswordInput strong").html(data.Message);
                                    }
                                    
                                    
                                },
                                error: function (jqXhr, json, errorThrown) {
                                    var errors = jqXhr.responseJSON;
                                    var error =  jqXhr.responseJSON.errors;
                                    console.log(errors);
                                    var errorsHtml = '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15">' + '<h4>Oops...! Something went Wrong !</h4>';
                                    if(error.current_password){
                                        $(".oldpasswordInput").css("display", "block"); 
                                        $(".oldpasswordInput strong").html(error.current_password[0]);
                                        errorsHtml += '<p class="text-muted mx-4 mb-0"> current password :  '+ error.current_password[0] +'</p>';

                                    }
                                    if(error.password){
                                        $(".password").css("display", "block"); 
                                        $(".password strong").html(error.password[0]);
                                        errorsHtml += '<p class="text-muted mx-4 mb-0"> password :  '+ error.current_password[0] +'</p>';

                                    }
                                    if(error.password_confirmation){
                                        $(".confirm_password").css("display", "block"); 
                                        $(".confirm_password strong").html(error.password_confirmation[0]);
                                        errorsHtml += '<p class="text-muted mx-4 mb-0"> password confirmation :  '+ error.current_password[0] +'</p>';

                                    }
                                        errorsHtml += '</div></div>';
                                    //I use SweetAlert2 for this
                                    Swal.fire({
                                        html: errorsHtml,
                                        showCancelButton: true,
                                        showConfirmButton: false,
                                        cancelButtonClass: 'btn btn-primary w-xs mb-1',
                                        cancelButtonText: 'Dismiss',
                                        buttonsStyling: false,
                                        showCloseButton: true
                                    });
                                }
                        });
                });
            });
        });
    </script>
@endsection
