@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-8 form-single-input-section">
        <div class="card">
            <div class="card-header card-header-section">
                <div class="pull-left">
                    @lang('home.send') @lang('home.mail')
                </div>
            </div>
            <div class="card-body">
               
                <form action="{{ route('sendmail.supplierstatement') }}" method="post" enctype="multipart/form-data">
                    @csrf
                 
                    <input type="hidden" name="supplierid" value="{{ $supplier->id }}">
                    <input type="hidden" name="from" value="{{ $from }}">
                    <input type="hidden" name="to" value="{{ $to }}">
                    <input type="hidden" name="suppliername" value="{{ $supplier->name }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Supplier</label>
                        <input type="text" class="form-control" name="client_name" value="{{ $supplier->name }}" placeholder="Recipients Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $supplier->email }}"  placeholder="Recipients" require>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Subject</label>
                        <input type="text" class="form-control" name="subject" value="Supplier Statement" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
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