@extends('layouts.master')
@section('content')
<style>
    .multi-select {
        height: 56px !important;
    }
</style>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header card-header-section">
            <div class="row">
                <div class="col-sm-8">
                    @lang('home.new') @lang('home.supplier')
                </div>
                <div class="col-sm-4">
                    <!--   <div class="form-group ">
                        <input type="text" class="form-control" id="suppliersearch" placeholder="Supplier" list="supplier" required>
                        <datalist id="supplier">
                        </datalist>

                    </div> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('partials.ErrorMessage')
            <form action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="response" name="response">
                @include('supplier.partials.supplierinputform')
        </div>
        <div class="card-footer card-footer-section">
            <div class="pull-right">
                <button type="submit" class="btn btn-lg btn-primary btn-block">@lang('home.submit')</button>
            </div>
            <div class="pull-right">
                <button class="btn btn-lg btn-secondary btn-block">@lang('home.reset')</button>
            </div>
            </form>
        </div>
    </div>
</div>
@include('supplier.partials.suppliercreatescript')
@endsection