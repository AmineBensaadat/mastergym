@extends('layouts.master')
@section('title') @lang('translation.add-member') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.member') @endslot
@slot('title') @lang('translation.Update-Memeber') @endslot
@endcomponent

<form id="createMember-form" method="POST" class="needs-validation"  action="{{ route('members_update') }}" novalidate enctype="multipart/form-data">
@csrf
    <input type="hidden" name="member_id" value="{{ $member->id }}">
    <div class="row">
        <!-- start col -->
        <div class="col-lg-8">
                <!-- start card -->
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="lastname-input">@lang('translation.lastname')</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname-input" value="{{ old('lastname') ? old('lastname') : $member->lastname }}" placeholder="@lang('translation.entrer the') @lang('translation.lastname')"  >
                                    @error('lastname')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="choices-gender" class="form-label">@lang('translation.gender')</label>
                                    <select name="gender" class="form-select" id="choices-gender">
                                        <option value="men" {{ $member->gender === "men" ? "selected" : "" }}> @lang('translation.men')</option>
                                        <option value="female" {{ $member->gender === "female" ? "selected" : "" }} >@lang('translation.female')</option>
                                        <option value="girl" {{ $member->gender === "girl" ? "selected" : "" }} >@lang('translation.girl')</option>
                                        <option value="boy" {{ $member->gender === "boy" ? "selected" : "" }} >@lang('translation.boy')</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone-input">@lang('translation.phone')</label>

                                        <div class="form-icon">
                                            <input type="phone" class="form-control form-control-icon" name="phone" id="phone-input" value="{{ old('phone') ? old('phone') : $member->phone }}" placeholder="@lang('translation.entrer the') @lang('translation.phone')">
                                            <i class="ri-phone-line"></i>
                                        </div>

                                        @error('phone')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="city-input">@lang('translation.city')</label>
                                        <input type="text" class="form-control" name="city" id="firstname-input" value="{{ old('city') ? old('city') : $member->city }}" placeholder="@lang('translation.entrer the') @lang('translation.city')" >
                                        @error('city')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="mb-3">
                                    <label class="form-label" for="cin-input">@lang('translation.CNIE')</label>
                                    <input type="text" class="form-control" name="cin" id="firstname-input" value="{{ old('cin') ? old('cin') : $member->cin }}" placeholder="@lang('translation.entrer the') @lang('translation.CNIE')" >
                                    @error('cin')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="firstname-input">@lang('translation.name')</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname-input" value="{{ old('firstname') ? old('firstname') : $member->firstname }}" placeholder="@lang('translation.entrer the') @lang('translation.name')">
                                    @error('firstname')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="dob-input">@lang('translation.day')</label>

                                    <div class="form-icon">
                                        <input type="date" class="form-control form-control-icon" name="dob" id="dob-input" value="{{ old('dob') ? old('dob') : $member->DOB }}" >
                                        <i class="ri-map-pin-time-line"></i>
                                    </div>

                                    @error('dob')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="emergency_contact-input">@lang('translation.emergency_cont')</label>

                                    <div class="form-icon">
                                        <input type="text" class="form-control form-control-icon" name="emergency_contact" id="emergency_contact" value="{{ old('emergency_contact') ? old('emergency_contact') : $member->emergency_contact }}" placeholder="@lang('translation.entrer the') @lang('translation.emergency_cont')"  >
                                        <i class="ri-cellphone-line"></i>
                                    </div>
                                    @error('emergency_contact')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="address-input">@lang('translation.address')</label>
                                        <input type="text" class="form-control" name="address" id="firstname-input" value="{{ old('address') ? old('address') : $member->address }}" placeholder="@lang('translation.entrer the') @lang('translation.address')" >
                                        @error('address')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone-input">@lang('translation.email')</label>

                                        <div class="form-icon">
                                            <input type="email" class="form-control form-control-icon" name="email" id="phone-input" value="{{ old('email') ? old('email') : $member->email }}" placeholder="@lang('translation.entrer the') @lang('translation.email')">
                                            <i class=" ri-mail-line"></i>
                                        </div>
                                        {{-- @error('email')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>

                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
        </div>

        <!-- end col -->
        <div class="col-lg-4">
            <!-- start card img -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="fs-14 mb-1">@lang('translation.images')</h5>
                        <p class="text-muted">@lang('translation.Add_image')</p>
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
                                        <img src="{{URL::asset(Helper::getImageByEntityId($member->id, "members", "profile") )}}" id="single-img" class="avatar-md" />
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

            <!-- start card -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="gym" class="form-label">@lang('translation.gym')</label>
                        <select name="gym" class="form-select" aria-label=".form-select-sm example" >
                            <option value="0">@lang('translation.chose')@lang('translation.gym')</option>
                            @foreach ($gyms as $gym)
                                <option {{ $gym->id === $member->gym_id ? "selected" : "" }} value="{{ $gym->id }}">{{ $gym->name }}</option>
                            @endforeach
                        </select>
                        @error('gym')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label" for="created_at-input">@lang('translation.created-at')</label>

                        <div class="form-icon">
                            <input type="date" class="form-control form-control-icon" name="created_at" id="created_at-input" value="{{ old('created_at') ? old('created_at') : date('Y-m-d', strtotime($member->created_at)) }}"  required>
                            <i class="ri-map-pin-time-line"></i>
                        </div>

                        @error('created_at')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="mb-3">
                        <label for="choices-status" class="form-label">@lang('translation.Status')</label>
                        <select name="status" class="form-select" id="choices-status">
                            <option value="1" selected>@lang('translation.Active')</option>
                            <option value="0">@lang('translation.Inactive')</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="health_issues-input">@lang('translation.health_issues')</label>

                        <div class="form-icon">
                            <input type="text" class="form-control form-control-icon" name="health_issues" id="phone-input" value="{{ old('health_issues') ? old('health_issues') : $member->health_issues }}" placeholder="@lang('translation.entrer the') @lang('translation.health_issues')">
                            <i class="ri-sword-fill"></i>
                        </div>

                        @error('health_issues')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="source-input">@lang('translation.source')</label>

                        <div class="form-icon">
                            <input type="text" class="form-control form-control-icon" name="source" id="source-input" value="{{ old('source') ? old('source') : $member->health_issues }}" placeholder="@lang('translation.entrer the') @lang('translation.source')">
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

        <div class="text-start mb-3">
            <button type="submit" class="btn btn-success w-sm">@lang('translation.Submit')</button>
        </div>
    </div>
    <!-- end row -->
</form>


@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
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

<script>
function padNumber(number) {
    var string  = '' + number;
    string      = string.length < 2 ? '0' + string : string;
    return string;
}
var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();

    var currentDay = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

$(document).ready(function(){

    var html = '';
    $("#services").on("change",function(){
        html = '';
        var serviceId = $(this).val();
        $.ajax({
            url :"/plans/allPlansByService",
            type:"POST",
            cache:false,
            data:{serviceId:serviceId, _token: '{{csrf_token()}}'},
            success:function(data){
                if((data.plans).length > 0){
                    $("#start_date").val(currentDay);
                    $("#end_date").val(getNextDate(data.plans[0].days));
                    $("#subscription-price").val(data.plans[0].amount);
                    $.each(data.plans, function (key, val) {
                        html += '<option value="'+val.id+'">'+val.plan_name+'</option>';
                        $("#plans").html(html);
                        $("#choices-discount").prop('disabled', false);
                        $("#payment-mode").prop('disabled', false);
                        $("#amount-received").prop('disabled', false);
                        $("#amount-pending").prop('disabled', false);
                        $("#additional-fees").prop('disabled', false);
                        $("#payment-comment").prop('disabled', false);
                    });
                }else{
                    html = '<option value="">Select plans</option>';
                    $("#end_date").val("");
                    $("#start_date").val("");
                    $("#subscription-price").val("");
                    $("#plans").html(html);
                    $("#choices-discount").prop('disabled', true);
                    $("#payment-mode").prop('disabled', true);
                    $("#amount-received").prop('disabled', true);
                    $("#amount-pending").prop('disabled', true);
                    $("#additional-fees").prop('disabled', true);
                    $("#payment-comment").prop('disabled', true);

                }
            }
        });
    });

    $("#plans").on("change",function(){
        var planId = $(this).val();
        $.ajax({
            url :"/plans/getPlansDays",
            type:"POST",
            cache:false,
            data:{planId:planId, _token: '{{csrf_token()}}'},
            success:function(data){
                $("#start_date").val(currentDay);
                $("#end_date").val(getNextDate(data.plans.days));
                $("#subscription-price").val(data.plans.amount);
            }
        });
    });

    $("#choices-discount").on("change",function(){
        if($(this).val() > 0 ){
            var discount = $(this).val();
        var amount =  $("#subscription-price").val();
        var amount_descounted = countDiscountAmount(amount, discount);
        $("#discount-amount-input").val(amount_descounted);
        }else{
            $("#discount-amount-input").val("");
        }
    });
});


function getNextDate(days){
    date      = new Date(currentDay);
    next_date = new Date(date.setDate(date.getDate() + days));
    formatted = next_date.getUTCFullYear() + '-' + padNumber(next_date.getUTCMonth() + 1) + '-' + padNumber(next_date.getUTCDate())
    return formatted;
}

function countDiscountAmount(price, percentage){
    calcPrice = price - ((price / 100) * percentage);
    return calcPrice;
}

</script>

@endsection

