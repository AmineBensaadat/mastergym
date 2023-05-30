@extends('layouts.master')
@section('title') @lang('translation.add') @lang('translation.member') @endsection
@section('css')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.pages') : @endslot
@slot('title') @lang('translation.edit-Invoice') @endslot
@endcomponent
<form id="update_invoice_form" method="POST" class="needs-validation"  action="{{ route('invoices_update') }}">
    @csrf
    <input type="hidden" name="member_id" value="{{ $invoice->member_id }}">
    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
     <!-- start card payment -->
    <div class="card border card-border-success">
        <div class="card-header">
            <h6 class="card-title mb-0">@lang('translation.Enter-details-of-the-invoice')</h6>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label" for="service-input">@lang('translation.services')</label>
                            <select name="service" id="services" class="form-select" aria-label=".form-select-sm example" required>
                                <option value="0">@lang('translation.chose')@lang('translation.Service')</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{  $service->id == $invoice->service_id ? "selected" : "" }}>{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="service-input">@lang('translation.plans')</label>
                            <select name="plans" id="plans" class="form-select" aria-label=".form-select-sm example" required>
                                @foreach ($plans_services as $plan_service)
                                    <option value=" {{ $plan_service->plan_id }}" {{  $plan_service->plan_id == $invoice->plan_id ? "selected" : "" }}>{{ $plan_service->plan_name }}</option>
                                @endforeach
                                </select>
                            @error('plans')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                     
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label" for="subscription-price">@lang('translation.subscription-price')</label>
                            <input type="number" class="form-control" name="subscription-price" value="{{ old('subscription-price') ? old('subscription-price') : $invoice->subscription_price  }}" id="subscription-price" placeholder="@lang('translation.entrer the') @lang('translation.subscription-price')"  >
                            @error('subscription-price')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="choices-amount-received" class="form-label">@lang('translation.Amount-Received')</label>
                            <input  type="number" class="form-control form-control-icon" name="amount-received" id="amount-received" value="{{ old('amount-received') ? old('amount-received') : $invoice->amount_received }}"  placeholder="@lang('translation.entrer the') @lang('translation.Amount-Received')">
                            @error('amount-received')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label" for="discount-input">@lang('translation.discount')</label>
                            <select  name="discount" class="form-select" id="choices-discount">
                                <option value="0" selected>@lang('translation.None')</option>
                                <option value="50" {{ $invoice->discount == 50 ? "selected" : "" }}>50 %</option>
                                <option value="80" {{ $invoice->discount == 80 ? "selected" : "" }}>80 %</option>
                            </select>
                            @error('discount')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="amount-pending-input">@lang('translation.amount-pending')</label>

                            <div class="form-icon">
                                <input  type="number" class="form-control" name="amount-pending" id="amount-pending" value="{{ old('amount-pending') ? old('amount-pending') : $invoice->amount_pending }}" placeholder="@lang('translation.entrer the') @lang('translation.amount-pending')" >
                            </div>
                            @error('amount-pending')
                            <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="mb-3">
                            <label class="form-label" for="discount-amount-input">@lang('translation.discount-amount')</label>
                            <input type="number" class="form-control" name="discount-amount" id="discount-amount-input" value="{{ old('discount-amount') ? old('discount-amount') : $invoice->discount_amount}}" placeholder="@lang('translation.entrer the') @lang('translation.discount-amount')">
                            @error('discount-amount')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="payment-mode-input">@lang('translation.payment-mode')</label>
                            <select  name="payment-mode" class="form-select" id="payment-mode">
                                <option value="cash" {{ $invoice->payment_mode == "cash" ? "selected" : "" }} >@lang('translation.cash')</option>
                                <option value="virement" {{ $invoice->payment_mode == "virement" ? "selected" : "" }}>@lang('translation.virement')</option>
                                <option value="cheque" {{ $invoice->payment_mode == "cheque" ? "selected" : "" }}>@lang('translation.check')</option>
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
                        <input  type="number" class="form-control" name="additional-fees" id="additional-fees" value="{{ old('additional-fees') ? old('additional-fees') : $invoice->additional_fees}}" placeholder="@lang('translation.entrer the') @lang('translation.additional-fees')"  >
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm">
                        <label class="form-label" for="payment-comment">@lang('translation.payment-comment')</label>
                        <textarea  name="payment-comment" class="form-control" value="{{ old('payment-comment') ? old('payment-comment') : $invoice->payment_comment}}" id="payment-comment" rows="3" placeholder="@lang('translation.entrer the')@lang('translation.payment-comment')"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="mt-4">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success w-sm">@lang('translation.Submit')</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- end card -->
</form>

@endsection

@section('script')
<script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection 