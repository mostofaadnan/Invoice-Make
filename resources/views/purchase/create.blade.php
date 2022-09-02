@extends('layouts.master')
@section('content')
<div class="col-lg-12">
    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">@lang('home.purchase')</a>
        </li>
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link" id="card-tab" data-toggle="tab" href="#card" role="tab" aria-controls="card" aria-selected="false">@lang('home.item') @lang('home.search')</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card card-design">
                <div class="card-header card-header-section">
                    <div class="card-title">
                        <h5 style="color:#fff;">@lang('home.new') @lang('home.purchase') @lang('home.order')</h5>
                    </div>
                    @include('section.purchasesection')
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    @include('section.itemsection')
                                </div>
                                <div class="card-body">
                                    <div class="my-custom-scrollbar my-custom-scrollbar-primary scrollbar-morpheus-den">
                                        @include('purchase.partials.purchaseTable')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer sum-section">
                    @include('purchase.partials.sumfootersection')
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="card" role="tabpanel" aria-labelledby="card-tab">

            @include('section.itemsearch')

        </div>
    </div>

</div>

<!-- @include('purchase.partials.sumfootersection') -->
@include('section.purchasemodel')
@include('purchase.partials.pcreatescripts')
@endsection