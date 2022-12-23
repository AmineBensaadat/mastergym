@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Ecommerce @endslot
@slot('title') Create Member @endslot
@endcomponent

<form id="createproduct-form" method="POST" class="needs-validation"  action="{{ route('members_store') }}" novalidate enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="member_firstname">@lang('translation.firstname')</label>
                                <input type="text" class="form-control" name="firstname" id="member_firstname" value="{{ old('firstname') }}" placeholder="@lang('translation.Enter_firstname')" required>
                                @error('firstname')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="member_lastname">@lang('translation.lastname')</label>
                                <input type="text" class="form-control" name="lastname" id="member_lastname" value="{{ old('lastname') }}" placeholder="@lang('translation.Enter_lastname')" required>
                                @error('lastname')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="member_cin">@lang('translation.cin')</label>
                                    <div class="form-icon right">
                                        <input type="text" class="form-control" name="cin" id="member_cin" value="{{ old('cin') }}" placeholder="@lang('translation.cin')" required>
                                        <i class="ri-bank-card-2-fill"></i>
                                    </div>
                                @error('cin')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="member_email">@lang('translation.email')</label>
                                <div class="form-icon right">
                                    <input type="email" class="form-control" name="email" id="member_email" value="{{ old('email') }}" placeholder="example@gmail.com" >
                                    <i class="ri-mail-unread-line"></i>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="member_address">@lang('translation.address')</label>
                                <div class="form-icon right">
                                    <input type="text" class="form-control" name="address" id="member_address" value="{{ old('member_address') }}" placeholder="@lang('translation.Enter_address')" required>
                                    <i class="ri-mail-unread-line"></i>
                                </div>
                                @error('address')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="dob">@lang('translation.dob')</label>
                                <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob') }}" placeholder="@lang('translation.Enter-dob')" required>
                                @error('dob')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.member_phone')</label>
                                <div class="form-icon right">
                                    <input type="text" class="form-control" name="member_phone" value="{{ old('member_phone') }}" placeholder="@lang('translation.Enter-phone-of-your-member')" required>
                                    <i class="ri-phone-fill"></i>
                                </div>
                                    @error('member_phone')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.emergency_contact')</label>
                                <input type="text" class="form-control" name="member_emergency_contact" value="{{ old('member_emergency_contact') }}" placeholder="@lang('translation.Enter-emergency-contact-of-your-member')" required>
                                @error('member_emergency_contact')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>       
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.health_issues')</label>
                                <input type="text" class="form-control" name="member_health_issues_contact" value="{{ old('member_health_issues_contact') }}" placeholder="@lang('translation.Enter-health-issues-of-your-member')" required>
                                @error('member_health_issues_contact')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.source')</label>
                                <input type="text" class="form-control" name="source" value="{{ old('source') }}" placeholder="@lang('translation.source')" required>
                                @error('source')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                
           <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Image profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">Image</h5>
                            <p class="text-muted">Add Main  Image.</p>
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

                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-gender" class="form-label">Gym</label>

                        <select name="gym" class="form-select" id="choices-gender">
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-gender" class="form-label">Status</label>

                        <select name="gender" class="form-select" id="choices-gender">
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-gender" class="form-label">Gender</label>

                        <select name="gender" class="form-select" id="choices-gender">
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-gender" class="form-label">Service</label>

                        <select name="gender" class="form-select" id="choices-gender">
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                </div>
                <!-- end card body -->
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-gender" class="form-label">Plan</label>
                        <select name="gender" class="form-select" id="choices-gender">
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                </div>
                <!-- end card body -->
            </div>
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

