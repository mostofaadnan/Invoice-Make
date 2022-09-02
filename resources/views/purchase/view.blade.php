@extends('layouts.master')
@section('content')
<div class="col-lg-12">
    <div class="card card-design">
        <div class="card-header card-header-section">
            @include('section.purchaseViewsection')
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
                        <div class="card-footer sum-section">
                            @include('purchase.partials.sumfootersection')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('section.purchasemodel')
@include('purchase.partials.pviewcripts')
@endsection