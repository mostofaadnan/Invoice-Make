@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-8 form-single-input-section">
        <div class="card">
            <div class="card-header card-header-section">
                <div class="pull-left">
                   @lang('home.mail')   @lang('home.send')
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('sendmail.purchasereturnsend') }}" method="post">
                    <input type="hidden" name="purchasereturnno" value="{{ $PurchaseReturn->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.purchase') @lang('home.return') @lang('home.number')</label>
                        <input type="text" class="form-control"  value="{{ $PurchaseReturn->return_code }}" placeholder="invoice no" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.supplier')</label>
                        <input type="text" class="form-control" name="client_name"  value="{{ $PurchaseReturn->SupplierName->name }}" placeholder="@lang('home.supplier')">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.email') @lang('home.address')</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $PurchaseReturn->SupplierName->email }}" placeholder="@lang('home.reciepent')">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.subject')</label>
                        <input type="text" class="form-control" name="subject"  value="Purchase Return" placeholder="@lang('home.subject')">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.message')</label>
                        <textarea name="message" rows="5" cols="40" class="form-control"></textarea>
                    </div>
            </div>
            <div class="card-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">@lang('home.submit')</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection