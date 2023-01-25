@extends('layouts.master')
@section('title') @lang('translation.add-member') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Ecommerce @endslot
@slot('title') @lang('translation.Create-Memeber') @endslot
@endcomponent
<div class="row">
    <!-- start col -->
    <div class="col-lg-6">
            <!-- start card subscription -->
            <div class="card border card-border-info">
                <div class="card-header">
                    <h6 class="card-title mb-0">@lang('translation.import-members')</h6>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                                <form id="upload-file" method="POST"  action="{{ route('import_member_store') }}" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label" >Upload File</label>
                                        <input class="form-control" name="file" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        @error('file')
                                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="submit" class="btn btn-success  ms-auto" >save</button>
                                </form>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
         <!-- end card -->
         <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <h4 class="mt-4 fw-semibold">Excel Canva</h4>
                                <p class="text-muted mt-3">Download the canva excel file to import the members</p>
                                <div class="mt-4">
                                    <a class="btn btn-primary" href="{{route('download_canva')}}" download="">            
                                        Click here to Download Excel canva
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-5 mb-2">
                            <div class="col-sm-7 col-8">
                                <img src="assets/images/verification-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

