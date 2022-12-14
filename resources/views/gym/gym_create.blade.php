@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Ecommerce @endslot
@slot('title') Create Gym @endslot
@endcomponent

<form id="createproduct-form" method="POST" autocomplete="off" class="needs-validation" action="/gym/store" novalidate enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="gym-name-input">Name</label>
                                <input type="text" class="form-control" name="gym_name" id="gym-name-input" value="{{ old('gym_name') }}" placeholder="Enter gym name" required>
                                @error('gym_name')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Address</label>
                                <input type="text" class="form-control" name="gym_address" id="gym-address-input" value="{{ old('gym_address') }}" placeholder="Enter address of your gym" required>
                                @error('gym_address')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Phone</label>
                                <input type="text" class="form-control" name="gym_phone" id="gym-phone-input" value="{{ old('gym_phone') }}" placeholder="Enter phone of your gym" required>
                                @error('gym_phone')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">Description</label>
                                <textarea name="gym_desc" class="form-control bg-light border-light" id="gym-desc-input" rows="3" placeholder="Enter descreption her"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Gallery</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">Product Image</h5>
                            <p class="text-muted">Add Product main Image.</p>
                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="product-image-input" class="mb-0"  data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" name="profile_image"  id="product-image-input" type="file"
                                            accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="" id="product-img" class="avatar-md h-auto" />
                                        </div>
                                    </div>
                                </div>
                                @error('profile_image')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <h5 class="fs-14 mb-1">Product Gallery</h5>
                            <p class="text-muted">Add Product Gallery Images.</p>

                            <div class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                    </div>

                                    <h5>Drop files here or click to upload.</h5>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <!-- This is used as the file preview template -->
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Product-Image" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- end dropzon-preview -->
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Gym statu</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-is_main" class="form-label">Is main ?</label>

                        <select name="is_main" class="form-select" id="choices-is_main">
                            <option value="1" selected>Is main</option>
                            <option value="0">Is not main</option>
                        </select>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end row -->
</form>


@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>

<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-product-create.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

