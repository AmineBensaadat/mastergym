@extends('layouts.master')
@section('title') @lang('translation.create-product') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Plan @endslot
@slot('title') @lang('translation.EDIT_PLAN') @endslot
@endcomponent
<form id="createplan-form" method="POST" class="needs-validation"  action="{{ route('update_plan') }}" novalidate enctype="multipart/form-data">
@csrf
    <div class="row">
        <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="plan-name-input">@lang('translation.name')</label>
                                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                <input type="text" class="form-control" name="plan_name" id="plan-name-input" value="{{ $plan->plan_name }}" placeholder="@lang('translation.Enter-name')" required>
                                @error('plan_name')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="product-title-input">@lang('translation.plan_descreption')</label>
                                <textarea name="plan_desc" class="form-control bg-light border-light" id="plan-desc-input" rows="3" placeholder="@lang('translation.Enter-plan-descreption-her')">{{ $plan->plan_details }}</textarea>
                            </div>

                            <div>
                                <h5 class="fs-14 mb-3">@lang('translation.Service')</h5>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                
                                            <select class="form-control" data-choices data-choices-removeItem name="service[]"multiple>
                                                
                                                @foreach ($services as $key => $service )
                                                    <option value="{{ $service->id }}" {{ Helper::checkIfServiceSlected($service->id, $plan->id) ? "selected" : "" }}>{{ $service->name }}  </option>
                                                @endforeach   
                                            </select> 
                                        </div>
                                        @error('service')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="plan-day-input">@lang('translation.day')</label>
                                <input type="number" class="form-control" name="plan_day" id="plan-day-input" value="{{ $plan->days }}" placeholder="@lang('translation.Enter-day')" required>
                                @error('plan_day')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="plan-amount-input">@lang('translation.amount')</label>
                                <input type="number" class="form-control" name="plan_amount" id="plan-amount-input" value="{{ $plan->amount }}" placeholder="@lang('translation.Enter_amount')" required>
                                @error('plan_amount')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="choices-status" class="form-label">@lang('translation.Status')</label>

                            <select name="status" class="form-select" id="choices-status">
                                <option value="1" selected>@lang('translation.Active')</option>
                                <option value="0">@lang('translation.Inactive')</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- end card -->
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">@lang('translation.Plan_Image')</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="fs-14 mb-1">@lang('translation.images')</h5>
                        <p class="text-muted">@lang('translation.Add_Plan_Image')</p>
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
                                        <img src="{{URL::asset(Helper::getImageByEntityId($plan->id, "plans", "profile") )}}" id="single-img" class="avatar-md" />
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
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-success w-sm">@lang('translation.Submit')</button>
        </div>
           <!-- end card -->


    <!-- end row -->
</form>


@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
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

