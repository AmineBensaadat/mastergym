@extends('layouts.master')
@section('title') @lang('translation.renew') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.subscriptions')  @endslot
@slot('title') @lang('translation.renew') @endslot
@endcomponent

<form id="createMember-form" method="POST" class="needs-validation"  action="{{ route('subscriptions_update') }}" >
@csrf
    <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
    <input type="hidden" name="member_id" value="{{ $subscription->member_id }}">
    <input type="hidden" name="status" value="1">
    <div class="row">
        <!-- start col -->
        <div class="col-lg-12">
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
                                            <option value="{{ $service->id }}" {{  $service->id == $subscription->service_id ? "selected" : "" }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="start_date">@lang('translation.start-date')</label>
                                    <input type="date" value="{{ $subscription->start_date }}" class="form-control" name="start_date" id="start_date"  placeholder="@lang('translation.entrer the') @lang('translation.start_date')" required>
                                    @error('start_date')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" name="facture" type="checkbox" role="switch" id="SwitchCheck3">
                                        <label class="form-check-label" for="SwitchCheck3">Facturé</label>
                                    </div>
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="service-input">@lang('translation.plans')</label>
                                    <select name="plans" id="plans" class="form-select" aria-label=".form-select-sm example" required>
                                        @foreach ($plans_services as $plan_service)
                                            <option value=" {{ $plan_service->plan_id }}" {{  $plan_service->plan_id == $subscription->plan_id ? "selected" : "" }}>{{ $plan_service->plan_name }}</option>
                                        @endforeach
                                        </select>
                                    @error('plans')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="end_date-input">@lang('translation.end-date')</label>

                                        <div class="form-icon">
                                            <input type="date" value="{{ $subscription->end_date }}" class="form-control form-control-icon" name="end_date" id="end_date"  placeholder="@lang('translation.entrer the') @lang('translation.end_date')" required>
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
                <div class="card border card-border-success card_facture" style="display: none;">
                    <div class="card-header">
                        <h6 class="card-title mb-0">@lang('translation.Enter-details-of-the-invoice')</h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="subscription-price">@lang('translation.subscription-price')</label>
                                    <input readonly type="number" class="form-control"  name="subscription-price" id="subscription-price" placeholder="@lang('translation.entrer the') @lang('translation.subscription-price')"  >
                                    @error('subscription-price')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="choices-amount-received" class="form-label">@lang('translation.Amount-Received')</label>
                                    <input type="number" class="form-control form-control-icon" name="amount-received" id="amount-received" value="{{ old('amount-received') }}"  placeholder="@lang('translation.entrer the') @lang('translation.Amount-Received')">
                                    @error('amount-received')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="discount-input">@lang('translation.discount')</label>
                                    <select name="discount" class="form-select" id="choices-discount">
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
                                        <input type="number" class="form-control" name="amount-pending" id="amount-pending" value="{{ old('amount-pending') ? old('amount-pending') : 0 }}" placeholder="@lang('translation.entrer the') @lang('translation.amount-pending')" >
                                    </div>
                                    @error('amount-pending')
                                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-sm">
                                <div class="mb-3">
                                    <label class="form-label" for="discount-amount-input">@lang('translation.discount-amount')</label>
                                    <input type="number" class="form-control" name="discount-amount" id="discount-amount-input" value="{{ old('discount-amount') }}" placeholder="@lang('translation.entrer the') @lang('translation.discount-amount')">
                                    @error('discount-amount')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="payment-mode-input">@lang('translation.payment-mode')</label>
                                    <select name="payment-mode" class="form-select" id="payment-mode">
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
                                    <input  type="number" class="form-control" name="additional-fees" id="additional-fees" value="{{ old('additional-fees') }}" placeholder="@lang('translation.entrer the') @lang('translation.additional-fees')"  >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <label class="form-label" for="payment-comment">@lang('translation.payment-comment')</label>
                                    <textarea  name="payment-comment" class="form-control" id="payment-comment" rows="3" placeholder="@lang('translation.entrer the')@lang('translation.payment-comment')"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
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

        $.ajax({
            url :"/plans/getPlansDays",
            type:"POST",
            cache:false,
            data:{planId:$("#plans").val(), _token: '{{csrf_token()}}'},
            success:function(data){
                $("#subscription-price").val(data.plans.amount);
            }
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

$('#SwitchCheck3').change(function() {
        if(this.checked) {
            $(".card_facture").css("display", "block");
        }else{
            $(".card_facture").css("display", "none"); 
        }       
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

