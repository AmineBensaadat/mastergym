@extends('layouts.master')
@section('title') @lang('translation.add-member') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Ecommerce @endslot
@slot('title') Create Memeber @endslot
@endcomponent

<form id="createproduct-form" method="POST" class="needs-validation"  action="/Memeber/store" novalidate enctype="multipart/form-data">
@csrf
    <div class="row">
        <!-- start col -->
        <div class="col-lg-8">
                <!-- start card -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="lastname-input">@lang('translation.lastname')</label>
                                <input type="text" class="form-control" name="lastname" id="lastname-input" value="{{ old('lastname') }}" placeholder="@lang('translation.entrer the') @lang('translation.lastname')" required>
                                @error('lastname')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="firstname-input">@lang('translation.firstname')</label>
                                <input type="text" class="form-control" name="firstname" id="firstname-input" value="{{ old('firstname') }}" placeholder="@lang('translation.entrer the') @lang('translation.firstname')" required>
                                @error('firstname')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="cin-input">@lang('translation.cin')</label>
                                <input type="text" class="form-control" name="cin" id="firstname-input" value="{{ old('cin') }}" placeholder="@lang('translation.entrer the') @lang('translation.cin')" required>
                                @error('cin')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="address-input">@lang('translation.address')</label>
                                <input type="text" class="form-control" name="address" id="firstname-input" value="{{ old('address') }}" placeholder="@lang('translation.entrer thee') @lang('translation.address')" required>
                                @error('address')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="phone-input">@lang('translation.phone')</label>

                                <div class="form-icon">
                                    <input type="phone" class="form-control form-control-icon" name="phone" id="phone-input" value="{{ old('phone') }}" placeholder="@lang('translation.entrer the') @lang('translation.phone')" required>
                                    <i class="ri-phone-line"></i>
                                </div>
                                
                                @error('phone')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="phone-input">@lang('translation.email')</label>

                                <div class="form-icon">
                                    <input type="email" class="form-control form-control-icon" name="email" id="phone-input" value="{{ old('email') }}" placeholder="@lang('translation.entrer thee') @lang('translation.email')" required>
                                    <i class=" ri-mail-line"></i>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- start card -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">Image</h5>
                            <p class="text-muted">Add profile Image.</p>
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
                                            <img src="{{ URL::asset('assets/images/img_icon.png') }}" id="single-img" class="avatar-md" />
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
        </div>
        <!-- end col -->
        <div class="col-lg-4">
            <!-- start card -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-is_main" class="form-label">gender</label>
                        <select name="is_main" class="form-select" id="choices-is_main">
                            <option value="men" selected>men</option>
                            <option value="female">female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="choices-is_main" class="form-label">status</label>
                        <select name="is_main" class="form-select" id="choices-is_main">
                            <option value="1" selected>active</option>
                            <option value="0">inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="dob-input">@lang('translation.dob')</label>

                        <div class="form-icon">
                            <input type="date" class="form-control form-control-icon" name="dob" id="dob-input" value="{{ old('dob') }}"  required>
                            <i class="ri-map-pin-time-line"></i>
                        </div>
                        
                        @error('dob')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="emergency_cont-input">@lang('translation.emergency_cont')</label>

                        <div class="form-icon">
                            <input type="text" class="form-control form-control-icon" name="emergency_cont" id="emergency_cont-input" value="{{ old('emergency_cont') }}" placeholder="@lang('translation.entrer thea') @lang('translation.emergency_cont')"  required>
                            <i class="ri-cellphone-line"></i>
                        </div>
                        
                        @error('emergency_cont')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="health_issues-input">@lang('translation.health_issues')</label>

                        <div class="form-icon">
                            <input type="text" class="form-control form-control-icon" name="health_issues" id="phone-input" value="{{ old('health_issues') }}" placeholder="@lang('translation.entrer thea') @lang('translation.health_issues')"  required>
                            <i class="ri-sword-fill"></i>
                        </div>
                        
                        @error('health_issues')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="source-input">@lang('translation.source')</label>

                        <div class="form-icon">
                            <input type="text" class="form-control form-control-icon" name="source" id="source-input" value="{{ old('source') }}" placeholder="@lang('translation.entrer thea') @lang('translation.source')"  required>
                            <i class="ri-sword-fill"></i>
                        </div>
                        
                        @error('source')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    
                </div>    
            </div>
            <!-- end card body -->
            </div>
            <!-- end card -->
        </div>

        <div class="text-start mb-3">
            <button type="submit" class="btn btn-success w-sm">Submit</button>
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
</script>
@endsection
