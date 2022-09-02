@extends('layouts.master')
@section('content')
<div class="col-lg-12">
    <div class="card card-design">
        <div class="card-header card-header-section">
            <div  class="card-title">
                <h5 style="color:#fff;">@lang('home.new') @lang('home.purchase') @lang('home.return')</h5>
            </div>
            @include('section.purchasereturnsection')
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
            <!--     <div class="col-sm-3">
            @include('purchase.partials.sumsection') 
            </div> -->
            </div>
        </div>
        <div class="card-footer sum-section">
        @include('purchase.partials.sumfootersection')
        </div>
    </div>
</div>

<!-- @include('purchase.partials.sumfootersection') -->
@include('section.purchasemodel')
@include('purchasereturn.partials.prcreatescripts')
@endsection