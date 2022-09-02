@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-8 form-single-input-section">
        <div class="card">
            <div class="card-header card-header-section">
                <div class="pull-left">
                    @lang('home.mail')  @lang('home.send')
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('sendmail.creditinvoicesend') }}" method="post">
                    <input type="hidden" name="invoiceid" value="{{ $invoice->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.invoice') @lang('home.number')</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $invoice->invoice_no }}" placeholder="@lang('home.invoice') @lang('home.number')" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.customer')</label>
                        <input type="text" class="form-control" name="client_name" aria-describedby="emailHelp" value="{{ $invoice->CustomerName->name }}" placeholder="@lang('home.customer')">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.email')</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $invoice->CustomerName->email }}" placeholder="@lang('home.email')">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('home.subject')</label>
                        <input type="text" class="form-control" name="subject" aria-describedby="emailHelp" value="Credit Invoice" placeholder="@lang('home.subject')">
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