@extends('layouts.master')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            @lang('home.new') @lang('home.grn')
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header card-header-section">
                            @lang('home.grn') @lang('home.input')
                        </div>
                        <div class="card-body">
                            @include('purchaserecieved.partials.formrecieved')
                        </div>
                        <div class="card-footer card-footer-section">
                            <div class="pull-right">
                                <div class="btn-group button-grp" role="group" aria-label="Basic example">
                                    <button type="submit" id="recieved" class="btn btn-success btn-lg">@lang('home.submit')</button>
                                    <button id="reset" class="btn btn-light btn-lg">@lang('home.reset')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header card-header-section">
                            <div class="form-row">
                                <div class="col-md-3 mb-1">
                                    <label for="validationDefault01">@lang('home.purchase') @lang('home.date')</label>
                                    <input type="text" name="openingdate" id="purchasedate" class="form-control" placeholder="@lang('home.purchase') @lang('home.date')" readonly>
                                </div>
                                <div class="col-md-5 mb-1">
                                    <label for="validationDefault02">@lang('home.supplier')</label>
                                    <input type="text" class="form-control" id="suppliersearch" data-catid="" placeholder="@lang('home.supplier')" readonly>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <label for="validationDefault01">@lang('home.reference') @lang('home.no')</label>
                                    <input type="text" class="form-control" placeholder="@lang('home.reference')" id="refno" readonly>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <label for="validationDefault01">@lang('home.shipment')</label>
                                    <input type="text" class="form-control" placeholder="@lang('home.shipment')" id="shipment" value="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include("purchaserecieved.partials.viewpurchaseTable")
                        </div>
                        <div class="card-footer sum-section">
                            @include("purchase.partials.viewpurchasesumsection")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include("purchaserecieved.partials.precievdscripts")
@endsection