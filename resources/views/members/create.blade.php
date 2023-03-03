@extends('layouts.master')
@section('title') @lang('translation.add-member') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Ecommerce @endslot
@slot('title') @lang('translation.Create-Memeber') @endslot
@endcomponent

<form id="createMember-form" method="POST" class="needs-validation"  action="{{ route('members_store') }}" novalidate enctype="multipart/form-data">
@csrf
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
                                    <input type="text" class="form-control" name="lastname" id="lastname-input" value="{{ old('lastname') }}" placeholder="@lang('translation.entrer the') @lang('translation.lastname')" required >
                                    @error('lastname')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="firstname-input">@lang('translation.name')</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname-input" value="{{ old('firstname') }}" placeholder="@lang('translation.entrer the') @lang('translation.name')" required>
                                    @error('firstname')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
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
                                        <label class="form-label" for="city-input">@lang('translation.city')</label>
                                        <input type="text" class="form-control" name="city" id="firstname-input" value="{{ old('city') }}" placeholder="@lang('translation.entrer the') @lang('translation.city')" required>
                                        @error('city')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="mb-3">
                                    <label class="form-label" for="cin-input">@lang('translation.CNIE')</label>
                                    <input type="text" class="form-control" name="cin" id="firstname-input" value="{{ old('cin') }}" placeholder="@lang('translation.entrer the') @lang('translation.CNIE')" required>
                                    @error('cin')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label for="choices-gender" class="form-label">@lang('translation.gender')</label>
                                    <select name="gender" class="form-select" id="choices-gender">
                                        <option value="men" selected>@lang('translation.men')</option>
                                        <option value="female">@lang('translation.female')</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="dob-input">@lang('translation.day')</label>

                                    <div class="form-icon">
                                        <input type="date" class="form-control form-control-icon" name="dob" id="dob-input" value="{{ old('dob') }}"  required>
                                        <i class="ri-map-pin-time-line"></i>
                                    </div>

                                    @error('dob')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="emergency_contact-input">@lang('translation.emergency_cont')</label>

                                    <div class="form-icon">
                                        <input type="text" class="form-control form-control-icon" name="emergency_contact" id="emergency_contact" value="{{ old('emergency_contact') }}" placeholder="@lang('translation.entrer the') @lang('translation.emergency_cont')"  required>
                                        <i class="ri-cellphone-line"></i>
                                    </div>
                                    @error('emergency_contact')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="address-input">@lang('translation.address')</label>
                                        <input type="text" class="form-control" name="address" id="firstname-input" value="{{ old('address') }}" placeholder="@lang('translation.entrer the') @lang('translation.address')" required>
                                        @error('address')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone-input">@lang('translation.email')</label>

                                        <div class="form-icon">
                                            <input type="email" class="form-control form-control-icon" name="email" id="phone-input" value="{{ old('email') }}" placeholder="@lang('translation.entrer the') @lang('translation.email')">
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

                <!-- start card subscription -->
                <div class="card border card-border-info">
                    <div class="card-header">
                        <h6 class="card-title mb-0">@lang('translation.Enter-details-of-the-subscription')</h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="service-input">@lang('translation.services')</label>
                                    <select name="service" id="services" class="form-select" aria-label=".form-select-sm example" required>
                                        <option value="0">@lang('translation.chose')@lang('translation.Service')</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="start_date">@lang('translation.start-date')</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"  placeholder="@lang('translation.entrer the') @lang('translation.start_date')" required>
                                    @error('start_date')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="service-input">@lang('translation.plans')</label>
                                    <select name="plans" id="plans" class="form-select" aria-label=".form-select-sm example" required>
                                        <option selected="" value="0">@lang('translation.chose')@lang('translation.plans')</option>
                                    </select>
                                    @error('plans')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="end_date-input">@lang('translation.end-date')</label>

                                        <div class="form-icon">
                                            <input type="date" class="form-control form-control-icon" name="end_date" id="end_date"  placeholder="@lang('translation.entrer the') @lang('translation.end_date')" required>
                                            <i class="ri-phone-line"></i>
                                        </div>

                                        @error('end_date')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- start card payment -->
                <div class="card border card-border-success">
                    <div class="card-header">
                        <h6 class="card-title mb-0">@lang('translation.Enter-details-of-the-invoice')</h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="subscription-price">@lang('translation.subscription-price')</label>
                                    <input readonly type="number" class="form-control" name="subscription-price" id="subscription-price" placeholder="@lang('translation.entrer the') @lang('translation.subscription-price')"  >
                                    @error('subscription-price')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="choices-amount-received" class="form-label">@lang('translation.Amount-Received')</label>
                                    <input disabled type="number" class="form-control form-control-icon" name="amount-received" id="amount-received" value="{{ old('amount-received') }}"  placeholder="@lang('translation.entrer the') @lang('translation.Amount-Received')">
                                    @error('amount-received')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="discount-input">@lang('translation.discount')</label>
                                    <select disabled name="discount" class="form-select" id="choices-discount">
                                        <option value="0" selected>@lang('translation.None')</option>
                                        <option value="50">50 %</option>
                                        <option value="80">80 %</option>
                                    </select>
                                    @error('discount')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="amount-pending-input">@lang('translation.amount-pending')</label>

                                    <div class="form-icon">
                                        <input disabled type="number" class="form-control" name="amount-pending" id="amount-pending" value="{{ old('amount-pending') }}" placeholder="@lang('translation.entrer the') @lang('translation.amount-pending')" >
                                    </div>
                                    @error('amount-pending')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="discount-amount-input">@lang('translation.discount-amount')</label>
                                    <input readonly type="number" class="form-control" name="discount-amount" id="discount-amount-input" value="{{ old('discount-amount') }}" placeholder="@lang('translation.entrer the') @lang('translation.discount-amount')">
                                    @error('discount-amount')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="payment-mode-input">@lang('translation.payment-mode')</label>
                                    <select disabled name="payment-mode" class="form-select" id="payment-mode">
                                        <option value="cash" selected>@lang('translation.cash')</option>
                                        <option value="virement">@lang('translation.virement')</option>
                                        <option value="cheque">@lang('translation.check')</option>
                                    </select>
                                    @error('payment-mode')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label class="form-label" for="additional-fees">@lang('translation.additional-fees')</label>
                                    <input disabled type="number" class="form-control" name="additional-fees" id="additional-fees" value="{{ old('additional-fees') }}" placeholder="@lang('translation.entrer the') @lang('translation.additional-fees')"  >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label class="form-label" for="payment-comment">@lang('translation.payment-comment')</label>
                                    <textarea disabled name="payment-comment" class="form-control" id="payment-comment" rows="3" placeholder="@lang('translation.entrer the')@lang('translation.payment-comment')"></textarea>
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

            <!-- start card -->
            <div class="card">
                <div class="card-body">
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
                            <input type="text" class="form-control form-control-icon" name="health_issues" id="phone-input" value="{{ old('health_issues') }}" placeholder="@lang('translation.entrer the') @lang('translation.health_issues')">
                            <i class="ri-sword-fill"></i>
                        </div>

                        @error('health_issues')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="source-input">@lang('translation.source')</label>

                        <div class="form-icon">
                            <input type="text" class="form-control form-control-icon" name="source" id="source-input" value="{{ old('source') }}" placeholder="@lang('translation.entrer the') @lang('translation.source')">
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
            <button type="submit" class="btn btn-success w-sm save_member">@lang('translation.Submit')</button>
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

$('.save_member').click(function(){
        var timerInterval;
        Swal.fire({
            title: 'Save Member',
            html: 'Member will be save in <strong></strong> seconds.',
            timer: 5000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: function () {
                Swal.showLoading()
                timerInterval = setInterval(function () {
                    var content = Swal.getHtmlContainer()
                    if (content) {
                        var b = content.querySelector('b')
                        if (b) {
                            b.textContent = Swal.getTimerLeft()
                        }
                    }
                }, 100)
            },
            onClose: function () {
                clearInterval(timerInterval)
            }
        })
    });

</script>

@endsection

