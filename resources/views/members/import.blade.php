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
                        @if (session('status'))
                            <div class="row">
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        @endif

                        
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                        <div class="row">
                                <form id="upload-file" method="POST"  action="{{ route('import_member_store') }}" novalidate enctype="multipart/form-data">
                                    @csrf
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
                                        <label class="form-label" for="services">@lang('translation.services')</label>
                                        <select name="service" id="services" class="form-select" aria-label=".form-select-sm example" required>
                                            <option value="0">@lang('translation.chose')@lang('translation.Service')</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

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

</script>

@endsection

