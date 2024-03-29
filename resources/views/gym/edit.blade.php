@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') gym @endslot
@slot('title') Edit Gym @endslot
@endcomponent

<form id="createproduct-form" method="POST" class="needs-validation"  action="{{ route('update_gym') }}" novalidate enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="gym-name-input">@lang('translation.name')</label>
                                <input type="hidden" name="gym_id" value="{{ $gym->id }}">
                                <input type="text"  class="form-control" name="gym_name" id="gym-name-input" value="{{ $gym->name }}" placeholder="@lang('translation.Enter-name')" required>
                                @error('gym_name')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.gym_address')</label>
                                <input type="text" class="form-control" name="gym_address" id="gym-address-input" value="{{ $gym->address }}" placeholder="@lang('translation.Enter-address-of-your-gym')">
                                @error('gym_address')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.gym_phone')</label>
                                <input type="text" class="form-control" name="gym_phone" id="gym-phone-input" value="{{ $gym->phone }}" placeholder="@lang('translation.Enter-phone-of-your-gym')">
                                @error('gym_phone')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.gym_descreption')</label>
                                <textarea name="gym_desc" class="form-control bg-light border-light" id="gym-desc-input" rows="3" placeholder="@lang('translation.Enter-descreption-her')">{{ $gym->desc }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

           <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">@lang('translation.images')</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">@lang('translation.images')</h5>
                            <p class="text-muted">@lang('translation.add_Main_Image')</p>
                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="single-image-input" class="mb-0"  data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none"  name="profile_image"  id="single-image-input" type="file"
                                            accept="image/png, image/gif, image/jpeg"
                                            onchange="document.getElementById('single-img').src = window.URL.createObjectURL(this.files[0])"
                                            >
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="{{URL::asset(Helper::getImageByEntityId($gym->id, "gyms", "profile") )}}" id="single-img" class="avatar-md" />
                                        </div>
                                    </div>
                                </div>
                                @error('profile_image')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <!-- end card -->

                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">@lang('translation.Submit')</button>
                </div>
        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('translation.Gym-status')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-is_main" class="form-label">@lang('translation.Is-main-?')</label>

                        <select name="is_main" class="form-select" id="choices-is_main" is_main_old="{{ $gym->is_main }}">
                            <option value="1" selected>@lang('translation.Is-main')</option>
                            <option value="0">@lang('translation.Is-not-main')</option>
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
<script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script>
const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

$("#attachment").on('change', function(e){
	for(var i = 0; i < this.files.length; i++){
    imageId = e.timeStamp;
    imageId = (imageId.toString()).split('.').join("");
		let fileBloc = $('<span/>', {class: 'file-block'}),
			 fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
		fileBloc.append('<span class="file-delete"><span>+</span></span>')
			.append(fileName);
      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);

      filesArr.forEach(function (f, index) {
        fileSizeKB = Math.round(f.size / 1024);
      });
    var html = '<li class="mt-2" id="'+imageId+'"> <div class="border rounded"> <div class="d-flex p-2"> <div class="flex-shrink-0 me-3"> <div class="avatar-sm bg-light rounded"> <img data-dz-thumbnail=""  style="height: inherit; width: inherit;" class="img-fluid rounded d-block image_name" src="' + window.URL.createObjectURL(this.files[0])+ '"> </div> </div> <div class="flex-grow-1"> <div class="pt-1"> <h5 class="fs-14 mb-1" data-dz-name="">'+this.files.item(i).name+'</h5> <p class="fs-13 text-muted mb-0" data-dz-size=""><strong>'+fileSizeKB +' KB</strong></p> <strong class="error text-danger" data-dz-errormessage=""></strong> </div> </div> <div class="flex-shrink-0 ms-3"> <button  class="btn btn-sm btn-danger remove_image" image_name="'+this.files.item(i).name+'">Delete</button> </div> </div> </div> </li>';

    $("#filesList").append(html);
	};
	// Ajout des fichiers dans l'objet DataTransfer
	for (let file of this.files) {
		dt.items.add(file);
	}
	// Mise à jour des fichiers de l'input file après ajout
	this.files = dt.files;

	// EventListener pour le bouton de suppression créé
	$('.remove_image').click(function(e){
		let name = $(this).attr('image_name');

		// Supprimer l'affichage du nom de fichier
		$(this).parent().parent().parent().remove();
		for(let i = 0; i < dt.items.length; i++){
			// Correspondance du fichier et du nom
			if(name === dt.items[i].getAsFile().name){
				// Suppression du fichier dans l'objet DataTransfer
				dt.items.remove(i);
				break;
			}
		}
		// Mise à jour des fichiers de l'input file après suppression
		document.getElementById('attachment').files = dt.files;
	});
});
var is_main_old = $("#choices-is_main").attr("is_main_old");
    $("#choices-is_main").val(is_main_old).change();
</script>
@endsection

